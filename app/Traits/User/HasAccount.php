<?php

namespace App\Traits\User;

use App\Profile;

trait HasAccount
{
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

        // Important for sending an email
        return $user;
    }

    /**
     * The user verifies their email address.
     *
     * @return void
     */
    public function verifiesEmail()
    {
        $this->verified = true;

        $this->save();

        $this->activationToken->delete();
    }

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
     * Update the user account.
     *
     * @param  array $data
     * @return App\User
     */
    public function updateAccount($data)
    {
        // Update access credentials
        $this->email = $data['email'];

        if($data['password'])
        {
            $this->password = $data['password'];
        }

        // Update profile
        if ($data['first_name'] && $data['last_name'])
        {
            $this->name = $data['name']; // check if works on profile update

            $this->assignProfile($data);
        }

        // Update roles
        if($data['role_id'])
        {
            $this->assignRole($data['role_id']);
        }

        $this->save();

        // Important for sending an email
        return $this;
    }

    /**
     * Delete the account.
     *
     * @param  string $path
     * @return void
     */
    public function deleteAccount()
    {
        $this->delete();
    }

    /**
     * The user has changed their access credentials.
     *
     * @param  string  $newEmail
     * @param  string  $newPassword
     * @return boolean
     */
    public function hasChangedAccessCredentials($newEmail, $newPassword)
    {
        return $this->hasChangedEmail($newEmail) || $this->hasChangedPassword($newPassword);
    }

    /**
     * The user has changed their email address.
     *
     * @param  string $newEmail
     * @return boolean
     */
    protected function hasChangedEmail($newEmail)
    {
        $oldEmail = $this->email;

        return $newEmail != $oldEmail;
    }

    /**
     * The user has changed their password.
     *
     * @param  string $password
     * @return boolean
     */
    protected function hasChangedPassword($newPassword)
    {
        $oldPassword = $this->password;

        return ! blank($newPassword) && ! \Hash::check($newPassword, $oldPassword);
    }
}