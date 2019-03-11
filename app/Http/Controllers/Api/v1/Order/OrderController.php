<?php

namespace App\Http\Controllers\Api\v1\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderCollection;
use App\Services\WoocommerceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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
    public function getOrders(Request $request)
    {
        $data = $request->all();

        $orders = $this->service->get('orders',
            [
                'customer' => Auth::user()->ID,
                'page'     => $data['page'] ?? 1,
                'per_page' => $data['per_page'] ?? 10,
                'order'    => $data['order'] ?? 'desc',
                'orderby'  => $data['orderby'] ?? 'date',
                'status'   => $data['status'] ?? 'any',
                'search'   => $data['search_string'] ?? ''
            ]);

        return response()->Success(new OrderCollection($orders['data']));
    }
}