<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionResourceCollection;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionApiController extends Controller
{
    private const PAGINATE_LIMIT = 10;

    public function index(): QuestionResourceCollection
    {
        return new QuestionResourceCollection(Question::paginate(self::PAGINATE_LIMIT));
    }

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

    public function show(Question $question): QuestionResource
    {
        return new QuestionResource($question);
    }
}
