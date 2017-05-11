<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CateInsertRequest extends Request
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => '类名不能为空',
        ];
    }
}
