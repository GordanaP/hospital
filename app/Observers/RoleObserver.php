<?php

namespace App\Observers;

use App\Role;

class RoleObserver
{
    /**
     * Listen to the Role creating event.
     *
     * @param  \App\Role  $role
     * @return void
     */
    public function creating(Role $role)
    {
        $role->slug = str_slug($role->name);
    }
}