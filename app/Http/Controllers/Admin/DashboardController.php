<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use App\Models\Quiz;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function dashboard(): View
    {
        return view('admin.dashboard',[
            'quizzes' => Quiz::all(),
            'questions' => Question::all(),
        ]);
    }
}
