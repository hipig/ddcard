<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GenerateAudioRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vcn' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'vcn' => '发音人',
        ];
    }
}
