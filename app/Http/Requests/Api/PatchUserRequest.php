<?php

namespace App\Http\Requests\Api;

class PatchUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'realname' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'realname.required' => '真实姓名必须填写',
            'realname.string' => '真实姓名格式错误'
        ];
    }
}
