<?php

namespace App\Traits\User;

trait HasAccount
{
    /**
     * Determine if the user has verified their account.
     *
     * @param  string $value
     * @return boolean
     */
    public function getIsVerifiedAttribute($value)
    {
        return $this->verified;
    }

    /**
     * Create the user account.
     *
     * @param  array $data
     * @return App\User
     */
    public static function createAccount($data)
    {
        $user = new static;

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        $user->save();

        return $user;
    }
}