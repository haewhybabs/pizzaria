<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReplyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $usersub;
    public $sub;
    public $userMessage;
    public $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userSub,$userMessage,$sub,$msg)
    {
        //
        $this->usersub = $userSub;
        $this->sub = $sub;
        $this->userMessage = $userMessage;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->sub)->view('admin.message.emailTemplate');
    }
}
