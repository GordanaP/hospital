<?php

namespace App\Http\Requests;

use App\Rules\AlphaNumSpace;
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
        switch ($this->method())
        {
            case 'POST':
                return [
                    'first_name' => [
                        'required','string', 'max:30',
                        new AlphaNumSpace,
                    ],
                    'last_name' => [
                        'required','string','max:30',
                        new AlphaNumSpace,
                    ],
                    'title' => 'required|in:'.ProfileTitle::getArray(),
                    'email' => 'required|string|email|max:100|unique:users,email',
                    'password' => 'required|string|min:6',
                ];
                break;
        }
    }
}
