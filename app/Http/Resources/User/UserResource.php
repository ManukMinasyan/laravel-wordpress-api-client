<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'ID'               => $this->ID,
            'user_email'       => $this->user_email,
            'first_name'       => $this->first_name,
            'last_name'        => $this->last_name,
            'birthday'         => $this->meta->description,
            "phone"            => $this->meta->phone,
            'avatar'           => 'https:' . $this->avatar,
            'billing_address'  => [
                'first_name'     => $this->meta->billing_first_name,
                'last_name'      => $this->meta->billing_last_name,
                'address_1' => $this->meta->billing_address_1,
                'address_2' => $this->meta->billing_address_2,
                'city'           => $this->meta->billing_city,
                'postcode'       => $this->meta->billing_postcode,
                'country'        => $this->meta->billing_country,
                'state'          => $this->meta->billing_state,
                'phone'          => $this->meta->billing_phone,
            ],
            'delivery_address' => [
                'address_1' => $this->meta->shipping_address_1,
                'address_2' => $this->meta->shipping_address_2,
                'city'           => $this->meta->shipping_city,
                'postcode'       => $this->meta->shipping_postcode,
                'country'        => $this->meta->shipping_country,
                'state'          => $this->meta->shipping_state,
                'additional_instruction' => $this->meta->shipping_additional_instruction
            ]
        ];
    }
}
