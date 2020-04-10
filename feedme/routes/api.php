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



Route::post("/previewApiNameFromMerchantName", "AuthController@previewApiNameFromMerchantName");

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post("registerMerchant", "AuthController@registerMerchant");
    Route::post("registerCustomer", "AuthController@registerCustomer");
});


Route::group([
    'prefix' => 'merchant'
], function ($router) {
    Route::get('/all', 'MerchantController@getAllMerchants');
});


Route::group([
    'middleware' => ['auth',"auth.merchant"],
    'prefix' => 'merchant'
], function ($router) {
    Route::get('/protected', 'MerchantController@protected');
    Route::post('/addProduct', 'MerchantController@addProduct');
    Route::get('/getAllProducts', 'MerchantController@getAllProducts');
    Route::get('/getAllOrders', 'MerchantController@getAllOrders');
    Route::post('/updateLogo', 'MerchantController@updateLogo');
    Route::post('/updateBanner', 'MerchantController@updateBanner');
});



Route::group([
    //'middleware' => ['auth','auth.customer'],
    'middleware' => ['auth:api','auth.customer'],
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




Route::get("/resendConfirmEmail/{userId}","AuthController@resendConfirmEmail");
Route::get("/merchant/{merchantId}","CustomerController@getMerchant");