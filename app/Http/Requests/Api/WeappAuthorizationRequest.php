<?php

namespace App\Http\Requests\Api;

class WeappAuthorizationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'avatar' => 'required',
            'code' => 'required|string',
        ];
    }
}
