<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'The email has already been taken',
            'password.required' => 'Required New Password',
            'password.min' => 'New Password minimal length 8 characters',
            'confpassword_confirmationirm_new_password.required' => 'Required New Password',
            'password_confirmation.same' => 'Password confirmation not same with Password',
        ];
    }
}
