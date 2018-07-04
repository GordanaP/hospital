<?php

namespace App;

use App\Observers\ProfileObserver;
use App\Title;
use App\Traits\Profile\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasSlug;

    /**
     * Bootstrap the application Profile service.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::observe(ProfileObserver::class);
    }

    /**
     * Get the user that owns the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
