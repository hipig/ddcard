<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VipSettingsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price' => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'duration' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'price' => '售价',
            'original_price' => '原价',
            'duration' => '时长',
        ];
    }
}
