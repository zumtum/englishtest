<?php

namespace App\Http\Controllers\Admin;

use App\Assignment;
use App\Mail\QuizAssigned;
use App\Quiz;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.assignments.index', [
            'assignments' => Assignment::with('quiz')->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Quiz $quiz)
    {
        if ($request->get('quiz_id')) {
            $quiz = Quiz::find($request->get('quiz_id'));
        }

        return view('admin.assignments.create', [
            'assignment' => [],
            'quizzes' => Quiz::all(),
            'assignedQuiz' => $quiz ?? null,
            'users' => User::with('roles')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Assignment  $assigment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assignment  $assigment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        return view('admin.assignments.edit', [
            'assignment' => $assignment,
            'quizzes' => Quiz::all(),
            'users' => User::with('roles')->get(),
            'relatedUsers' => $assignment->users()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assignment  $assigment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assignment  $assigment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        $assignment->users()->detach();
        $assignment->delete();

        return redirect()->route('admin.assignment.index');
    }

    /**
     * @param Assignment $assignment
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Assignment $assignment)
    {
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
    private function sendMail(array $emails, Quiz $quiz)
    {
        Mail::to($emails)
            ->cc(Auth::user()->email)
            ->send(new QuizAssigned($quiz));
    }
}
