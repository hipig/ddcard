<?php

namespace App\Http\Requests\Admin;

class ProfileRequest extends FormRequest
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
