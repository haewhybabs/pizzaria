<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyUser extends Mailable
{
    use Queueable, SerializesModels;
    public $code, $name, $subj, $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code, $name, $subj, $msg)
    {
        $this->code = $code;
        $this->name = $name;
        $this->subj = $subj;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        // echo $this->name. " ". $this->code;die;
        return $this->subject($this->subj)->view('user.verifyTemplate');
    }
}
