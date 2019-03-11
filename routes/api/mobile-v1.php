<?php

    Route::group(['namespace' => 'Api\v1'], function () {

        Route::group(['prefix' => 'user', 'namespace'=>'User', 'middleware' => 'doNotCacheResponse'], function () {
            Route::post('login', 'UserController@login');
            Route::post('register', 'UserController@register');
            Route::post('forgot-password', 'UserController@forgotPassword');


            Route::group(['middleware' => 'auth:api'], function() {
                Route::get('/','UserController@getUser');
                Route::post('/save', 'UserController@saveUser');
                Route::post('/save-billing-address', 'UserController@saveBillingAddress');
                Route::post('/save-delivery-address', 'UserController@saveDeliveryAddress');
            });
        });

        Route::group(['prefix' => 'category', 'namespace' => 'Category', 'middleware' => 'auth:api'], function(){
           Route::get('/', 'CategoryController@getList');
        });

        Route::group(['prefix' => 'product', 'namespace' => 'Product', 'middleware' => 'auth:api'], function(){
           Route::get('/search', 'ProductController@searchProducts');
           Route::get('/details/{product_id}', 'ProductController@getDetails');
           Route::get('/', 'ProductController@getList');
        });

        Route::group(['prefix' => 'shipping', 'namespace' => 'Shipping', 'middleware' => 'auth:api'], function(){

            Route::prefix('methods')->group(function(){
                Route::get('/', 'ShippingMethodController@getlist');
            });

        });

        Route::group(['prefix' => 'cart', 'namespace' => 'Cart', 'middleware' => 'auth:api'], function(){
            Route::get('/list', 'CartController@getCartList');
            Route::post('/add', 'CartController@addToCart');
            Route::delete('/remove', 'CartController@removeFromCart');
            Route::post('/clear', 'CartController@clearCart');
            Route::post('/update', 'CartController@updateItemCart');
            Route::get('/totals', 'CartController@getTotalsCart');
        });

        Route::group(['prefix' => 'order', 'namespace' => 'Order', 'middleware' => 'auth:api'], function(){
            Route::get('/', 'OrderController@getOrders');
        });

        Route::group(['prefix' => 'review', 'namespace' => 'Review', 'middleware' => 'auth:api'], function(){
            Route::get('/{id}', 'ReviewController@getReviewById');
            Route::get('/', 'ReviewController@getReviews');
            Route::post('/', 'ReviewController@postReview');
        });
    });
