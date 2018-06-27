<?php

namespace App\Traits\User;

use App\Role;

trait HasRoles
{
    /**
     * Get the roles that belong to the user.
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * A user has a specified role.
     *
     * @param  App\Role  $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role))
        {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    /**
     * Assigne a role to a user.
     *
     * @param  \App\Role $role
     * @return mixed
     */
    public function assignRole($role)
    {
        return $this->roles()->sync($role);
    }

    /**
     * Revoke a user's role.
     *
     * @param  numeric $role
     * @return void
     */
    public function revokeRole($role)
    {
        $roles = Role::whereIn('id', $role)->get();

        $this->roles()->detach($roles);
    }

    /**
     * Determine if the user is a doctor
     *
     * @param  string $value
     * @return boolean
     */
    public function getIsDoctorAttribute($value)
    {
        return $this->hasRole('doctor');
    }

    /**
     * Determine if the user is an administrator
     *
     * @param  string $value
     * @return boolean
     */
    public function getIsAdminAttribute($value)
    {
        return $this->hasRole('admin');
    }

    /**
     * Determine if the user is a super administrator
     *
     * @param  string $value
     * @return boolean
     */
    public function getIsSuperAdminAttribute($value)
    {
        return $this->hasRole('superadmin');
    }
}