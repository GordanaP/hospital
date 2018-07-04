<?php

namespace App\Rules;

use App\Role;
use App\Title;
use Illuminate\Contracts\Validation\Rule;

class BelongsToRole implements Rule
{
    protected $role_ids;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($role_ids)
    {
        $this->role_ids = $role_ids;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $title = Title::find($value);
        $role = Role::find($title->role_id);

        return in_array($role->id, $this->role_ids);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The title does not belong to the role.';
    }
}
