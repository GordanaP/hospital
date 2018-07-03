<?php

namespace App;

use App\Observers\RoleObserver;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Bootstrap the application Role service.
     *
     * @return void
     */

    protected static function boot()
    {
        parent::boot();

        static::observe(RoleObserver::class);
    }

    /**
     * Get the users that belong to the role.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function titles()
    {
        return $this->hasMany(Title::class);
    }
}
