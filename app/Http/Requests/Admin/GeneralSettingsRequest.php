<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'daily_unlock_times' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'daily_unlock_times' => '每日可解锁次数',
        ];
    }
}
