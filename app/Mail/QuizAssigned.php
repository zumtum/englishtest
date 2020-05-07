<?php

namespace App\Mail;

use App\Quiz;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuizAssigned extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The quiz instance.
     *
     * @var Quiz
     */
    protected $quiz;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($quiz)
    {
        $this->quiz = $quiz;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.quizzes.assigned', [
            'quiz' => $this->quiz,
        ]);
    }
}
