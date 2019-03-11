<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id'             => $this->id,
            'parent_id'      => $this->parent_id,
            'customer_id'    => $this->customer_id,
            'number'         => $this->number,
            'order_key'      => $this->order_key,
            'status'         => $this->status,
            'currency'       => $this->currency,
            'date_created'   => $this->date_created,
            'total'          => $this->total,
            'billing'        => $this->billing,
            'shipping'       => $this->shipping,
            'payment_method' => $this->payment_method
        ];
    }
}
