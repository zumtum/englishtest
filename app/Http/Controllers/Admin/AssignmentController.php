<?php

namespace App\Http\Controllers\Admin;

use App\Models\Assignment;
use App\Mail\QuizAssigned;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AssignmentController extends Controller
{
    private const PAGINATE_LIMIT = 10;
    private const PUBLISHED_FLAG = 1;

    public function index(): View
    {
        return view('admin.assignments.index', [
            'assignments' => Assignment::with('quiz')
                ->orderBy('created_at', 'desc')
                ->paginate(self::PAGINATE_LIMIT),
        ]);
    }

    public function create(Request $request, Quiz $quiz)
    {
        $this->authorize(Assignment::class);

        if ($request->get('quiz_id')) {
            $quiz = Quiz::where('published', self::PAGINATE_LIMIT)->find($request->get('quiz_id'));
        }

        return view('admin.assignments.create', [
            'assignment' => [],
            'quizzes' => Quiz::where('published', self::PUBLISHED_FLAG)->get(),
            'assignedQuiz' => $quiz ?? null,
            'users' => User::with('roles')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize(Assignment::class);

        /** @var $assignment Assignment */
        $assignment = Assignment::create($request->all());

        if ($request->input('users')) {
            $assignment->users()->attach($request->input('users'));
        }

        if ($request->input('send')) {
            $quiz = Quiz::find($assignment->quiz_id);

            $this->sendMail($request->input('emails'), $quiz);

            $assignment->update(['sended' => true]);
        }

        return redirect()->route('admin.assignment.index');
    }

    public function edit(Assignment $assignment): View
    {
        $this->authorize($assignment);

        return view('admin.assignments.edit', [
            'assignment' => $assignment,
            'quizzes' => Quiz::all(),
            'users' => User::with('roles')->get(),
            'relatedUsers' => $assignment->users()->get(),
        ]);
    }

    public function update(Request $request, Assignment $assignment): RedirectResponse
    {
        $this->authorize($assignment);

        $assignment->update();

        $assignment->users()->detach();

        if ($request->input('users')) {
            $assignment->users()->attach($request->input('users'));
        }

        if ($request->input('send')) {
            $quiz = Quiz::find($request->input('quiz_id'));

            $this->sendMail($request->input('emails'), $quiz);

            $assignment->update(['sended' => true]);
        }

        return redirect()->route('admin.assignment.index');
    }

    public function destroy(Assignment $assignment): RedirectResponse
    {
        $this->authorize($assignment);

        $assignment->users()->detach();
        $assignment->delete();

        return redirect()->route('admin.assignment.index');
    }

    public function send(Assignment $assignment): RedirectResponse
    {
        $this->authorize($assignment);

        $emails = $assignment->users()->pluck('email')->toArray();
        $quiz = Quiz::find($assignment->quiz_id);

        $this->sendMail($emails, $quiz);

        $assignment->update(['sended' => true]);

        return redirect()->route('admin.assignment.index');
    }

    /**
     * @param array $emails
     * @param Quiz $quiz
     */
    private function sendMail(array $emails, Quiz $quiz): void
    {
        Mail::to($emails)
            ->cc(Auth::user()->email)
            ->send(new QuizAssigned($quiz));
    }
}
