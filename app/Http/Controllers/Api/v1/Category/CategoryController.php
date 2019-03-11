<?php

namespace App\Http\Controllers\Api\v1\Category;

use App\Http\Resources\Category\CategoryCollection;
use App\Services\WoocommerceService;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
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
     * @return mixed
     */
    public function getList()
    {
        $parameters = [
            'page' => $data['page'] ?? 1,
            'per_page' => $data['per_page'] ?? 10,
            'order' => $data['order'] ?? 'asc',
            'orderby' => $data['orderby'] ?? 'name',
            'exclude' => [16, 38]
        ];

        $categories = $this->service->get('products/categories', $parameters);

        return response()->Success(new CategoryCollection($categories['data']));
    }
}
