<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'id' => $this->id,
            'product_id' => $this->product_id,
            'date_created' => $this->date_created,
            'status' => $this->status,
            'reviewer' => $this->reviewer,
            'reviewer_email' => $this->reviewer_email,
            'review' => $this->review,
            'rating' => $this->rating,
            'reviewer_avatar_urls' => $this->reviewer_avatar_urls
        ];
    }
}
