<?php

namespace App\Traits\User;

use App\Profile;

trait HasProfile
{
    /**
     * Get the profile that belongs to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // public function assignProfile($data)
    // {
    //     $profile = $this->profile ?: new Profile;

    //     if($data['first_name'] && $data['last_name'] && $data['title']) {

    //         $profile->title = $data['title'];
    //         $profile->first_name = $data['first_name'];
    //         $profile->last_name = $data['last_name'];
    //     }

    //     $this->profile()->save($profile);
    // }

    /**
     * Create the profile slug during profile update.
     *
     * @param  \App\User $user
     * @param  string $name
     * @return string
     */
    // protected function getSlug($profile, $first_name, $last_name)
    // {
    //     $currentName = getFullName($profile->first_name, $profile->last_name);
    //     $newName = getFullName($first_name, $last_name);

    //     $slug = $newName == $currentName ?  $profile->slug : Profile::uniqueNameSlug($newName);

    //     return $slug;
    // }
    //
    public function assignProfile($data)
    {
        $profile = $this->profile ?: new Profile;

        if($data['first_name'] && $data['last_name'] && $data['title']) {

            $slug = $this->getSlug($profile, $data['first_name'], $data['last_name']);

            $profile->title = $data['title'];
            $profile->first_name = $data['first_name'];
            $profile->last_name = $data['last_name'];
            $profile->slug = $slug;
        }

        if($data['education']){

            $profile->education = $data['education'];
        }

        $this->profile()->save($profile);

        $newUsername = setUsername($profile->first_name, $profile->last_name);

        $profile->user->name = $newUsername;
        $profile->user->save();

        return $profile;
    }

    /**
     * Create the profile slug during profile update.
     *
     * @param  \App\User $user
     * @param  string $name
     * @return string
     */
    protected function getSlug($profile, $first_name, $last_name)
    {
        $currentName = getFullName($profile->first_name, $profile->last_name);
        $newName = getFullName($first_name, $last_name);

        $slug = $newName == $currentName ?  $profile->slug : Profile::uniqueNameSlug($newName);

        return $slug;
    }
}