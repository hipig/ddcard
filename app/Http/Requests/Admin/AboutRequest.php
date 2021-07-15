<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AboutRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required',
                    'key' => [
                        'required',
                        Rule::unique('abouts')
                    ],
                    'content' => 'required',
                ];
            case 'PUT':
                return [
                    'name' => 'required',
                    'key' => [
                        'required',
                        Rule::unique('abouts')->ignore($this->route('about'))
                    ],
                    'content' => 'required',
                ];
        }
    }

    public function attributes()
    {
        return [
            'name' => '名称',
            'key' => '标识',
            'content' => '主要内容',
        ];
    }
}
