<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'department' => 'required|max:255',
            'email' => 'required|unique:users,email|min:3|max:255',
            'phone' => 'required|numeric|unique:users,phone|digits:10',
            'password' => 'required|string|min:8|max:16',
        ];
    }
}
