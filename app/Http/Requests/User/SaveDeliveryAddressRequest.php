<?php

namespace App\Http\Requests\User;

use App\Http\Foundation\CustomFormRequest;

class SaveDeliveryAddressRequest extends CustomFormRequest
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
            'address_1' => 'nullable|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'postcode' => 'nullable|max:255',
            'country' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'additional_instruction' => 'nullable|string|max:1000'
        ];
    }
}
