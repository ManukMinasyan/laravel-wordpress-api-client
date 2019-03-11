<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 04.02.2019
 * Time: 14:11
 */

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Cookie;

class WordpressService
{
    /**
     * @param string $uri
     * @param array  $data
     *
     * @return mixed|null|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($uri = '', $data = [])
    {
        return $this->request($uri, 'GET', $data);
    }


    /**
     * @param string $uri
     * @param array  $data
     *
     * @return mixed|null|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($uri = '', $data = [])
    {
        return $this->request($uri, 'POST', $data);
    }


    /**
     * @param string $uri
     * @param array  $data
     *
     * @return mixed|null|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($uri = '', $data = [])
    {
        return $this->request($uri, 'DELETE', $data);
    }

    /**
     * @param $uri
     * @param $method
     * @param $data
     *
     * @return mixed|null|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function request($uri, $method, $data)
    {
        $cookieJar = CookieJar::fromArray(Cookie::get(),
            config('wordpress.WP_WC_DOMAIN'));
        $client = new Client([
            'base_uri' => config('wordpress.WP_WC_URL') . '/wp-json/wp/v2/',
            'cookies'  => $cookieJar
        ]);

        try {
            $data = json_decode($client->request($method, $uri,
                ["json" => $data])->getBody(), true);
            $response = [
                'success' => true,
                'data' => $data
            ];
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
            $data = collect(json_decode((string)$response->getBody(), true))->except('status');

            $response = [
                'success' => false,
                'code' => $e->getCode(),
                'data' => $data
            ];
        }

        return $response;
    }
}