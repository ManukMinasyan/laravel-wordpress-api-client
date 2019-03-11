<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 2/26/2019
 * Time: 12:22 AM
 */

namespace App\Http\Foundation;

use Illuminate\Contracts\Validation\Validator;
use \Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomFormRequest extends  BaseFormRequest {

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->Error(implode(" ", $validator->errors()->all()), 400));
    }

}