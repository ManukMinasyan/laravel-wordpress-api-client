<?php

namespace App\Http\Resources\Shipping;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ShippingMethodsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function ($review) {
            return (new ShippingMethodsResource($review));
        });


        return parent::toArray($request);
    }
}
