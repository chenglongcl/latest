<?php

namespace App\Http\Requests\Admin;

use Dingo\Api\Http\FormRequest as DingoFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FormRequest extends DingoFormRequest
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

    protected function failedValidation(Validator $validator)
    {
        throw new HttpException(422, $validator->errors()->first());
    }
}
