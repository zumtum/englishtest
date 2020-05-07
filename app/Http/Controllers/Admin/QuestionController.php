<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use App\Models\QuestionType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class QuestionController extends Controller
{
    private const PAGINATE_LIMIT = 10;

    public function index(): View
    {
        return view('admin.questions.index', [
            'questions' => Question::with('author')
                ->orderBy('created_at', 'desc')
                ->paginate(self::PAGINATE_LIMIT),
        ]);
    }

    public function create(): View
    {
        $this->authorize(Question::class);

        return view('admin.questions.create', [
            'question' => [],
            'types' => QuestionType::get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize(Question::class);

        $request->validate([
            'title' => ['required', 'string'],
            'scores' => ['required', 'integer'],
        ]);

        /** @var $question Question */
        $question = Question::create($request->all());

        if ($request->input('answers')) {
            $answers = json_decode($request->input('answers'), true);

            $question->answers()->createMany($answers);
        }

        return redirect()->route('admin.question.index');
    }

    public function edit(Question $question): View
    {
        $this->authorize($question);

        return view('admin.questions.edit', [
            'question' => $question,
            'types' => QuestionType::get(),
            'answers' => $question->answers()->get(),
        ]);
    }

    public function update(Request $request, Question $question): RedirectResponse
    {
        $this->authorize($question);

        $request->validate([
            'title' => ['required', 'string'],
            'scores' => ['required', 'integer'],
        ]);

        $question->update($request->except(['slug', 'text']));
        $question->answers()->delete();

        if ($request->input('answers')) {
            $answers = json_decode($request->input('answers'), true);
            $question->answers()->createMany($answers);
        }

        return redirect()->route('admin.question.index');
    }

    public function destroy(Question $question): RedirectResponse
    {
        $this->authorize($question);

        $question->answers()->delete();
        $question->delete();

        return redirect()->route('admin.question.index');
    }
}
