<?php

namespace App\Observers;

use App\Profile;

class ProfileObserver
{
    /**
     * Listen to the Profile creating event.
     *
     * @param  \App\Profile  $profile
     * @return void
     */
    public function creating(Profile $profile)
    {
        $profile->slug = Profile::uniqueNameSlug($profile->full_name);
    }
}