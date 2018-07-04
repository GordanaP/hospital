<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DoNotExcludeEachOther implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $arr = [];

        foreach ($value as $id)
        {
            array_push($arr, $id);
        }

        return $arr != [1, 2];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The selected values exclude each another..';
    }
}
