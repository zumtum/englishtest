<?php

namespace App\Http\Controllers\Admin;

use App\Question;
use App\Quiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard',[
            'quizzes' => Quiz::all(),
            'questions' => Question::all(),
        ]);
    }
}
