<?php

namespace App\Http\Controllers\Admin;

use App\Question;
use App\Quiz;
use App\QuizType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.quizzes.index', [
            'quizzes' => Quiz::orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quizzes.create', [
            'quiz' => [],
            'types' => QuizType::get(),
            'questions' => Question::get(),
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
            'title' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'integer'],
        ]);

        $quiz = Quiz::create($request->all());

        if ($request->input('questions')) {
            $quiz->questions()->attach($request->input('questions'));
        }

        return redirect()->route('admin.quiz.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        return view('admin.quizzes.edit', [
            'quiz' => $quiz,
            'types' => QuizType::get(),
            'questions' => Question::get(),
            'relatedQuestions' => $quiz->questions()->get(),
            'userId' => Auth::user()->getAuthIdentifier(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
//            'title' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'integer'],
        ]);

        $quiz->update($request->except('slug'));

        $quiz->questions()->detach();

        if ($request->input('questions')) {
            $quiz->questions()->attach($request->input('questions'));
        }

        return redirect()->route('admin.quiz.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('admin.quiz.index');
    }
}
