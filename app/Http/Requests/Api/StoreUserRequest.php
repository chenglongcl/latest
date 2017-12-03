<?php

namespace App\Http\Requests\Api;


class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名必须填写',
            'name.string' => '用户名格式错误',
            'name.unique' => '用户名已存在',
            'email.required' => 'email必须填写',
            'email.email' => 'email格式错误',
            'email.unique' => 'email已存在',
            'password.required' => '密码必须填写',
            'password.min' => '密码至少:min位',
        ];
    }
}
