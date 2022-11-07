<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required|current_password',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password|different:old_password',
        ];
    }

    public function messages()
    {
        return [
            'old_password.current_password' => 'Old Password is Wrong',
            'old_password.required' => 'Required Old Password',
            'new_password.required' => 'Required New Password',
            'new_password.min' => 'New Password minimal length 8 characters',
            'confirm_new_password.required' => 'Required New Password',
            'confirm_new_password.same' => 'Password confirmation not same with New Password',
            'confirm_new_password.different' => 'New Password must be different with Old Password',
        ];
    }
}
