<?php

namespace App\Http\Requests\Api;

class StorePhotoRequest extends FormRequest
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
            'picture' => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            'picture.required' => '请上传图片',
            'picture.image' => '请检查图片格式（jpeg、png、bmp、gif、或 svg）'
        ];
    }
}
