<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class QuizController extends Controller
{
    private const PUBLISHED_FLAG = 1;

    public function index(): AnonymousResourceCollection
    {
        return QuizResource::collection(Quiz::where('published', self::PUBLISHED_FLAG)->get());
    }
}
