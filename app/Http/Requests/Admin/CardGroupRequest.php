<?php

namespace App\Http\Requests\Admin;

class CardGroupRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'zh_name' => 'required',
            'en_name' => 'required',
            'color' => 'required',
            'is_lock' => 'required',
            'status' => 'required',
            'index' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'zh_name' => '中文名称',
            'en_name' => '英文名称',
            'color' => '样式',
            'is_lock' => '锁定状态',
        ];
    }
}
