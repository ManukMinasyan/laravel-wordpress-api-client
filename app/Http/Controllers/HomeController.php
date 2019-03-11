<?php

namespace App\Http\Controllers;

use App\Services\WoocommerceCartService;
use Illuminate\Cookie\CookieJar;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    private $service, $client;

    public function __construct(
        WoocommerceCartService $service
    ) {
        $this->service = $service;
//        $this->client = new Client([
//            'base_uri' => config('wordpress.WP_WC_URL')
//                . '/wp-json/wc/v2/cart/',
//            'Accept'     => 'application/json',
//            'cookies'  => true
//        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return $this->service->post('add', [
            'product_id' => 1461,
            'quantity' => 100
        ]);

//        $value = Cache::get('key');
//        $expiresAt = now()->addMinutes(10);

//        Cache::put('key', 'value', $expiresAt);

//        return dd($this->service->post('products/reviews',
//            [
//                'product_id'     => 10,
//                'review'         => 10,
//                'reviewer'       => 10,
//                'reviewer_email' => 10,
//                'rating'         => 10
//            ]));
        $response = $this->service->get();

        return $response;
    }

    public function get() {

//        $cookieJar = CookieJar::fromArray(Cookie::get(), 'haze420.co.uk');
//
//        $product = $this->client->request('GET', '', ['cookies' => $cookieJar]);
//
//        dd(json_decode($product->getBody()->getContents()));
//
//        return response()->json([]);
    }
}
