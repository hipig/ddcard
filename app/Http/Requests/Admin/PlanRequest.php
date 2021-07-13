<?php

namespace App\Http\Requests\Admin;

class PlanRequest extends FormRequest
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
            'price' => 'required',
            'period' => 'required',
            'interval' => 'required',
            'description' => 'required',
            'status' => 'required',
            'index' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '名称',
            'price' => '价格',
            'period' => '时长',
            'interval' => '周期',
            'description' => '描述',
        ];
    }
}
