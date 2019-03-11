<?php

namespace App\Http\Controllers\Api\v1\Review;

use App\Http\Controllers\Controller;
use App\Http\Resources\Review\ReviewCollection;
use App\Http\Resources\Review\ReviewResource;
use App\Services\WoocommerceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    private $service;

    /**
     * OrderController constructor.
     *
     * @param WoocommerceService $service
     */
    public function __construct(WoocommerceService $service)
    {
        $this->service = $service;
    }


    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getReviews(Request $request)
    {
        $data = $request->all();

        $reviews = $this->service->get('products/reviews/',
            [
                'product'  => $data['product'],
                'page'     => $data['page'] ?? 1,
                'per_page' => $data['per_page'] ?? 10,
                'order'    => $data['order'] ?? 'desc',
                'orderby'  => $data['orderby'] ?? 'date_gmt',
                'status'   => $data['status'] ?? 'any',
                'search'   => $data['search'] ?? ''
            ]);

        return response()->Success(new ReviewCollection($reviews['data']));
    }


    /**
     * @param string $id
     *
     * @return mixed
     */
    public function getReviewById($id = '')
    {
        $review = $this->service->get('products/reviews/' . $id);

        return response()->Success(new ReviewResource($review['data']));
    }


    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function postReview(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        $review = $this->service->post('products/reviews',
            [
                'product_id'     => $data['product_id'],
                'review'         => $data['review'],
                'reviewer'       => $user->first_name . ' ' . $user->last_name,
                'reviewer_email' => $user->email,
                'rating'         => $data['rating']
            ]);

        return response()->Success(new ReviewResource($review['data']));
    }
}
