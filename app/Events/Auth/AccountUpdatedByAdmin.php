<?php

namespace App\Events\Auth;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class AccountUpdatedByAdmin
{
    use Dispatchable, SerializesModels;

    public $email;
    public $password;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}
