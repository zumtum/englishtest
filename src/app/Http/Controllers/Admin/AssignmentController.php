<?php

namespace App\Http\Controllers\Admin;

use App\Assignment;
use App\Quiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'assignments' => Assignment::orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.assignments.create', [
            'assignment' => [],
            'quizzes' => Quiz::all(),
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assignment  $assigment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assigment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assignment  $assigment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assigment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assignment  $assigment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assigment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assignment  $assigment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assigment)
    {
        //
    }
}
