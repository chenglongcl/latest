<?php

namespace App\Http\Requests\Admin;

class StoreAuthRequest extends FormRequest
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
            'name' => 'required',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名必须填写',
            'password.required' => '密码必须填写',
            'password.min' => '密码至少:min位',
        ];
    }
}
