<?php

namespace App\Http\Requests\User;

use App\Http\Foundation\CustomFormRequest;

class SaveBillingAddressRequest extends CustomFormRequest
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
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'company' => 'string|max:255',
            'address_1' => 'string|max:255',
            'address_2' => 'nullable|string|max:255',
            'city' => 'string|max:255',
            'postcode' => 'max:255',
            'country' => 'string|max:255',
            'state' => 'string|max:255',
            'phone' => 'string|max:255'
        ];
    }
}
