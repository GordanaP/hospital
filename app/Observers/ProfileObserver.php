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
        $name = getFullName($profile->first_name, $profile->last_name);

        $profile->slug = Profile::uniqueNameSlug($name);
    }
}