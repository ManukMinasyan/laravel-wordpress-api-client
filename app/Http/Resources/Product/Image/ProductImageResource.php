<?php

namespace App\Http\Resources\Product\Image;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
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
            'thumbnail' => $this->woocommerce_thumbnail,
            'gallery_thumbnail' => $this->woocommerce_gallery_thumbnail,
        ];
    }
}
