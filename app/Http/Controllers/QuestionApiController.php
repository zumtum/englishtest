<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionResourceCollection;
use App\Question;
use Illuminate\Http\Request;

class QuestionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return QuestionResourceCollection
     */
    public function index(): QuestionResourceCollection
    {
        return new QuestionResourceCollection(Question::paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return QuestionResource
     */
    public function store(Request $request): QuestionResource
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'integer'],
            'scores' => ['required', 'integer'],
        ]);

        $question = Question::create($request->all());

        return new QuestionResource($question);
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return QuestionResource
     */
    public function show(Question $question): QuestionResource
    {
        return new QuestionResource($question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
