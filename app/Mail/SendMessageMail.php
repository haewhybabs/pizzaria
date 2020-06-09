<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMessageMail extends Mailable
{
    use Queueable, SerializesModels;
    public $fr;
    public $sub;
    public $comments;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fr,$sub,$comments)
    {
        //
        $this->fr = $fr;
        $this->sub = $sub;
        $this->comments = $comments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fr)->subject('You got message')->replyTo($this->fr)->view('user.emailTemplate');
    }
}
