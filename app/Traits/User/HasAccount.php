<?php

namespace App\Traits\User;

use App\Profile;

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
        // Create account
        $user = new static;

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        $user->save();

        // Create profile
        $user->assignProfile($data);

        // Assign role
        $user->assignRole($data['role_id']);

        return $user;
    }

    /**
     * Update the user account.
     *
     * @param  array $data
     * @return App\User
     */
    public function updateAccount($data)
    {
        $this->email = $data['email'];

        if($data['password'])
        {
            $this->password = $data['password'];
        }

        if ($data['first_name'] && $data['last_name'])
        {
            $this->name = $data['name']; // check if works on profile update

            $this->assignProfile($data);
        }

        if($data['role_id'])
        {
            $this->assignRole($data['role_id']);
        }

        $this->save();

        return $this;
    }

}