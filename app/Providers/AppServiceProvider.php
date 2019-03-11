<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Response::macro('Success', function ($data = null, $status = 200, $headers = []) {
            $content = [
                'success' => true,
                'data' => $data
            ];

            return \Response::make($content, $status, $headers);
        });

        \Response::macro('Error', function ($data = null, $status = 400, $headers = []) {
            $content = [
                'success' => false,
                'error' => [
                    'code' => $status,
                    'message' => $data
                ]
            ];

            return \Response::make($content, $status, $headers);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
