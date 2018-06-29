<?php

namespace App\Traits\User;

trait HasAttributes
{
    /**
     * Set the user name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $name = request()->first_name[0] . request()->last_name;

        $this->attributes['name'] = strtolower($name);
    }

    /**
     * Set the user email.
     *
     * @param  string  $value
     * @return void
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * Set the user password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}