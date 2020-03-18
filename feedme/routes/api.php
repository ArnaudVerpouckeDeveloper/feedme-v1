<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});




Route::group([
    'middleware' => ['auth',"auth.merchant"],
    'prefix' => 'merchant'
], function ($router) {
    Route::get('/protected', 'MerchantController@protected');
    Route::post('/addProduct', 'MerchantController@addProduct');
    Route::get('/getAllProducts', 'MerchantController@getAllProducts');
    Route::get('/getAllOrders', 'MerchantController@getAllOrders');
});



Route::group([
    'middleware' => ['auth','auth.customer'],
], function ($router) {
    Route::post('/placeOrder', 'CustomerController@placeOrder');
});



Route::group([
    'middleware' => ['auth.customer'],
    'prefix' => 'test'
], function ($router) {
    Route::get("/merchant-protected", function(){
        return "ok";
    });
});





Route::get("/merchant/{merchantId}","CustomerController@getMerchant");