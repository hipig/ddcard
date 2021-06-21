<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'group_id' => 'required',
            'zh_name' => 'required',
            'en_name' => 'required',
            'cover' => 'required',
            'color' => 'required',
            'status' => 'required',
            'index' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'group_id' => '分组',
            'zh_name' => '中文名称',
            'en_name' => '英文名称',
            'cover' => '封面',
            'color' => '样式',
        ];
    }
}
