<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PleaseActivateYourAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $password)
    {
        $this->token = $token;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirm Your Email Address')
            ->markdown('emails.auth.activate_account');
    }
}
