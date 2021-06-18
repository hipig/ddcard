<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'phone' => [
                'nullable',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
                Rule::unique('users')->ignore($this->route('user')),
            ],
            'email' => [
                'nullable',
                'string',
                'email',
                Rule::unique('users')->ignore($this->route('user')),
            ],
            'password' => 'nullable|string|confirmed|min:6',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '昵称',
        ];
    }
}
