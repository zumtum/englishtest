<?php

namespace App\Mail;

use App\Models\Quiz;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuizAssigned extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The quiz instance.
     *
     * @var Quiz
     */
    protected $quiz;

    public function __construct($quiz)
    {
        $this->quiz = $quiz;
    }

    /**
     * Build the message.
     */
    public function build(): QuizAssigned
    {
        return $this->view('emails.quizzes.assigned', [
            'quiz' => $this->quiz,
        ]);
    }
}
