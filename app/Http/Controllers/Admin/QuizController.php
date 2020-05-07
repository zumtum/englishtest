<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class QuizController extends Controller
{
    private const PAGINATE_LIMIT = 10;

    public function index(): View
    {
        return view('admin.quizzes.index', [
            'quizzes' => Quiz::with('questions')
                ->orderBy('created_at', 'desc')
                ->paginate(self::PAGINATE_LIMIT),
        ]);
    }

    public function create(): View
    {
        $this->authorize(Quiz::class);

        return view('admin.quizzes.create', [
            'quiz' => [],
            'types' => QuizType::all(),
            'userId' => Auth::user()->getAuthIdentifier(),
            'questions' => Question::with('author')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize(Quiz::class);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        /** @var Quiz $quiz */
        $quiz = Quiz::create($request->all());

        if ($request->input('questions')) {
            $quiz->questions()->attach($request->input('questions'));
        }

        return redirect()->route('admin.quiz.index');
    }

    public function show(Quiz $quiz): void
    {
        $this->authorize($quiz);
    }

    public function edit(Quiz $quiz): View
    {
        $this->authorize($quiz);

        return view('admin.quizzes.edit', [
            'quiz' => $quiz,
            'types' => QuizType::get(),
            'questions' => Question::with('author')->get(),
            'relatedQuestions' => $quiz->questions()->get(),
            'userId' => Auth::user()->getAuthIdentifier(),
        ]);
    }

    public function update(Request $request, Quiz $quiz): RedirectResponse
    {
        $this->authorize($quiz);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        $quiz->update($request->except('slug'));

        $quiz->questions()->detach();

        if ($request->input('questions')) {
            $quiz->questions()->attach($request->input('questions'));
        }

        return redirect()->route('admin.quiz.index');
    }

    public function destroy(Quiz $quiz): RedirectResponse
    {
        $this->authorize($quiz);

        $quiz->questions()->detach();
        $quiz->delete();

        return redirect()->route('admin.quiz.index');
    }
}
