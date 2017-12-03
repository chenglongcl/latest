<?php

namespace App\Http\Requests\Admin;

class StoreAdminRequest extends FormRequest
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
            'name' => 'required|string|unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'role' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '管理员名必须填写',
            'name.string' => '管理员名格式错误',
            'name.unique' => '管理员名已存在',
            'email.required' => 'email必须填写',
            'email.email' => 'email格式错误',
            'email.unique' => 'email已存在',
            'password.required' => '密码必须填写',
            'password.min' => '密码至少:min位',
            'role.required' => '管理员角色必选',
        ];
    }
}
