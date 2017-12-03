<?php

namespace App\Http\Requests\Api;

class StorePostRequest extends FormRequest
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
            'cid' => 'required|integer',
            'title' => 'required|string',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cid.required' => '必须选择栏目',
            'cid.integer' => '栏目ID错误',
            'title.required' => '标题必须填写',
            'content.required' => '内容必须填写'
        ];
    }
}
