<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'alpha_num|required|unique:users|min:6',
            'first_name' => 'string|required|max:255',
            'last_name' => 'string|required|max:255',
            'email' => 'email|required|unique:users|min:5',
            'phone_number' => 'numeric',
            'status' => 'boolean|required',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
