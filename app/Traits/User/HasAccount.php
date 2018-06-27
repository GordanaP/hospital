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
}