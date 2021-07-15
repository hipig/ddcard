<?php

namespace App\Http\Requests\Admin;

class FeedbackReplyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'content' => '内容',
        ];
    }
}
