<?php

namespace App;

use App\Traits\User\HasAccount;
use App\Traits\User\HasAttributes;
use App\Traits\User\HasProfile;
use App\Traits\User\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable,
        HasAccount,
        HasAttributes,
        HasProfile,
        HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_verified' => 'boolean',
    ];
}
