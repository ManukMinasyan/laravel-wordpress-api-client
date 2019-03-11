<?php

namespace App\Http\Controllers\Api\v1\Shipping;

use App\Http\Resources\Shipping\ShippingMethodsCollection;
use App\Services\WoocommerceService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ShippingMethodController extends Controller
{
    private $woocommerceService;

    /**
     * ShippingMethodController constructor.
     *
     * @param WoocommerceService $woocommerceService
     */
    public function __construct(WoocommerceService $woocommerceService)
    {
        $this->woocommerceService = $woocommerceService;
    }


    /**
     * @return mixed
     */
    public function getList()
    {
        $shipping_methods = $this->woocommerceService->get('shipping_methods');

        return response()->Success(new ShippingMethodsCollection($shipping_methods['data']));
    }
}
