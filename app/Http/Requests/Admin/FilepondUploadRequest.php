<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FilepondUploadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [
            'required'
        ];

        switch ($this->type) {
            case 'image':
                $rule[] = 'image';
                break;
        }
        return [
            'filepond' => $rule
        ];
    }
}
