<?php

use Pecee\{
    Http\Request,
    SimpleRouter\SimpleRouter as Router
};

use \app\middlewares\{
    ProccessRawBody,
    Authenticate,
    Customer,
    Vendor,
    Courier
};

Router::get('/user-migration', '\app\migrations\UserMigration@execute');
//Router::post('/api', '\app\controllers\ApiController@calcDeliveryCost');

Router::group([
    'prefix' => 'api/v1',
    'middleware' => [
        ProccessRawBody::class
    ]
], function () {
    Router::post('/auth/login', '\app\controllers\AuthController@login');
    Router::group([
        'middleware' => [
            Authenticate::class
        ]
    ], function () {
        // authenticated routes
        Router::group([
            'middleware' => [
                Customer::class
            ]
        ], function () {
            // Customer routes
            Router::post('/calculate', '\app\controllers\ApiController@calcDeliveryCost');
            Router::post('/order/create', '\app\controllers\ApiController@createOrder');
        });

        Router::group([
            'middleware' => [
                Vendor::class
            ]
        ], function () {
            // Vendor routes
            Router::get('/order/all', '\app\controllers\ApiController@getOrderList');
        });

        Router::group([
            'middleware' => [
                Vendor::class,
                Courier::class
            ]
        ], function () {
            // Vendor & Courier routes
            Router::get('/order/get/{id}', '\app\controllers\ApiController@getOrder')
                ->where(['id' => '[\d]+']);
        });
    });
});

Router::error(function(Request $request, Exception $exception) {
    $response = Router::response();

    $response->header('Retry-After: 60');
    $response->header('X-RateLimit-Limit: 60');
    $response->header('X-RateLimit-Remaining: 54');

    $response->httpCode($exception->getCode());

    return $response->json([
        'status' => 'error',
        'message' => $exception->getMessage()
    ]);
});
