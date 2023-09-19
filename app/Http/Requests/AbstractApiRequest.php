<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class AbstractApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->error('バリデーション失敗', $validator->errors()->all()));
    }
}
