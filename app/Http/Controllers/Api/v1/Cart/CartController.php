<?php

namespace App\Http\Controllers\Api\v1\Cart;

use App\Http\Controllers\Controller;
use App\Services\WoocommerceCartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartService;

    /**
     * CartController constructor.
     *
     * @param WoocommerceCartService $cartService
     */
    public function __construct(WoocommerceCartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCartList()
    {
        $cartList = $this->cartService->get();

        $cookies = collect($cartList['headers'])->only('Set-Cookie')->toArray();

        return response()->Success($cartList['data'], 200, $cookies);
    }


    /**
     * @param Request $request
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addToCart(Request $request)
    {
        $data = $request->only('product_id', 'quantity');

        $product = $this->cartService->post('add', $data);

        $cookies = collect($product['headers'])->only('Set-Cookie')->toArray();

        return response()->Success($product['data'], 200, $cookies);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function removeFromCart(Request $request)
    {
        $data = $request->only('cart_item_key');

        $response = $this->cartService->delete('cart-item', $data);

        $cookies = collect($response['headers'])->only('Set-Cookie')->toArray();

        return response()->Success($response['data'], 200, $cookies);
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function clearCart() {
        $response = $this->cartService->post('clear');

        $cookies = collect($response['headers'])->only('Set-Cookie')->toArray();

        return response()->Success($response['data'], 200, $cookies);
    }


    /**
     * @param Request $request
     *
     * @return mixed|null|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateItemCart(Request $request)
    {
        $data = $request->only('cart_item_key', 'quantity');

        $response = $this->cartService->post('cart-item', $data);

        $cookies = collect($response['headers'])->only('Set-Cookie')->toArray();

        return response()->Success($response['data'], 200, $cookies);
    }


    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTotalsCart() {
        $response = $this->cartService->get('totals');

        $cookies = collect($response['headers'])->only('Set-Cookie')->toArray();

        return response()->Success($response['data'], 200, $cookies);
    }
}
