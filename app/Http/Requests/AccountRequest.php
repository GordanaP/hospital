<?php

namespace App\Http\Requests;

use App\Rules\AlphaNumSpace;
use App\Rules\BelongsToRole;
use App\Rules\DoNotExcludeEachOther;
use App\Services\Utilities\ProfileTitle;
use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = optional($this->user)->id ?: \Auth::id();

        switch ($this->method())
        {
            case 'POST':
                return [
                    'first_name' => [
                        'required','string', 'max:30',
                        new AlphaNumSpace(),
                    ],
                    'last_name' => [
                        'required','string','max:30',
                        new AlphaNumSpace(),
                    ],
                    'role_id' => [
                        'required', 'array', 'distinct', 'max:2', 'exists:roles,id',
                        new DoNotExcludeEachOther()
                    ],
                    'title' => [
                        'exists:titles,id',
                        new BelongsToRole($this->role_id),
                    ],
                    'email' => 'required|string|email|max:100|unique:users,email',
                    'password' => 'required|string|min:6',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                return [
                    'first_name' => [
                        'sometimes','required','string','max:30', //the field is present only on admin update (sometimes)
                        new AlphaNumSpace(),
                    ],
                    'last_name' =>  [
                        'sometimes','required','string','max:30',
                        new AlphaNumSpace(),
                    ],
                    'role_id' => [
                        'required', 'array', 'distinct', 'max:2', 'exists:roles,id',
                        new DoNotExcludeEachOther()
                    ],
                    'title' => [
                        'exists:titles,id',
                        new BelongsToRole($this->role_id),
                    ],
                    'email' => 'required|string|email|max:100|unique:users,email,'.$userId,
                    'password' => [
                        'nullable',
                        'required_if:create_password,manual',
                        'string', 'min:6', 'confirmed'
                    ],
                ];
                break;
        }
    }
}