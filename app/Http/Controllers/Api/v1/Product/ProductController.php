<?php

namespace App\Http\Controllers\Api\v1\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Services\WoocommerceService;
use Illuminate\Http\Request;

class ProductController extends Controller
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
     * @return ProductCollection
     */
    public function getList(Request $request)
    {
        $data = $request->all();

        $parameters = collect([
            'page'     => $data['page'] ?? 1,
            'per_page' => $data['per_page'] ?? 10,
            'offset' => $data['offset'] ?? 0,
            'order'    => $data['order'] ?? 'desc',
            'orderby'  => $data['orderby'] ?? 'date',
            'min_price'  => $data['min_price'] ?? '',
            'max_price'  => $data['max_price'] ?? '',
            'search'   => $data['search'] ?? ''
        ]);

        if($request->has('category')){
            $parameters->prepend($data['category'], 'category');
        }

        if($request->has('on_sale')){
            $parameters->prepend($data['on_sale'], 'on_sale');
        }

        if($request->has('stock_status')){
            $parameters->prepend($data['stock_status'], 'stock_status');
        }

        $products = $this->service->get('products', $parameters->toArray());

        return response()->Success(new ProductCollection($products['data']));
    }


    /**
     * @param Request $request
     * @param         $product_id
     *
     * @return ProductResource
     */
    public function getDetails(Request $request, $product_id)
    {
        $product = $this->service->get('products/' . $product_id);

        $this->service->get('products/'.$product_id);

        return response()->Success(new ProductResource($product['data']));
    }
}
