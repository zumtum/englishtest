<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Question;
use App\QuestionType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.questions.index', [
            'questions' => Question::with('author')
                ->orderBy('created_at', 'desc')
                ->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.questions.create', [
            'question' => [],
            'types' => QuestionType::get(),
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('admin.questions.edit', [
            'question' => $question,
            'types' => QuestionType::get(),
            'answers' => $question->answers()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->answers()->delete();
        $question->delete();

        return redirect()->route('admin.question.index');
    }
}
