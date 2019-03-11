<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Product\Image\ProductImageCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
        $images = collect($this->images);

        return [
            'id'               => $this->id,
            'categories' => $this->categories,
            'name'            => $this->name,
            'slug'            => $this->slug,
            'permalink'            => $this->permalink,
            'description'          => $this->description,
            'thumbnail_image' => $images->first()->woocommerce_gallery_thumbnail,
            'images'            => new ProductImageCollection($images),
            'weight'           => $this->weight,
            'price'            => $this->price,
            'regular_price'        => $this->regular_price,
            'sale_price'        => $this->sale_price,
            "average_rating" => $this->average_rating,
            "rating_count" => $this->rating_count,
            'attributes' => [
                'weight'    => collect($this->attributes)
                    ->where('name', 'Weight')->first()->options,
                'thc_level' => collect($this->attributes)
                    ->where('name', 'THC')->first()->options
            ]
        ];
    }
}
