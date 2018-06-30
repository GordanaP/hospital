<?php

namespace App\Events\Auth;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class AccountCreatedByAdmin
{
    use Dispatchable, SerializesModels;

    public $user;
    public $password;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }
}
