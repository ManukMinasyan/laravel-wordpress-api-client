<?php

namespace App\Http\Resources\Product\Image;

use App\Http\Models\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductImageCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function ($product) {
            return (new ProductImageResource($product));
        });


        return parent::toArray($request);
    }
}
