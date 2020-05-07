<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserInvited extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Build the message.
     */
    public function build(): UserInvited
    {
        return $this->view('emails.users.invited');
    }
}
