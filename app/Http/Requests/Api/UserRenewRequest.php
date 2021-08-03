<?php

namespace App\Http\Requests\Api;

class UserRenewRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'plan_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'plan_id' => '会员方案',
        ];
    }
}
