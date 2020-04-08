<?php

use Illuminate\Support\Facades\Route;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('email/verify', "AuthController@verifyEmailNotice")->name('verification.notice');


Route::get("/manager/login", function () {
    return view("merchantLogin");
})->name("login");
Route::post("/manager/login", "AuthController@logMerchantIn");


Route::get("/manager/register", function () {
    return view("merchantRegister");
});
Route::post("/manager/register", "AuthController@registerMerchant");
Route::get("/manager/logout", "AuthController@logMerchantOut");


Route::group([
    'middleware' => ['auth', "auth.merchant", "verified"],
], function ($router) {
    Route::get('/manager/dashboard', "MerchantController@showManagerDashboard");
    Route::get('/manager/orders', "MerchantController@showManagerOrders");
    Route::get('/manager/producten', "MerchantController@showManagerProducts");
    Route::get('/manager/instellingen', "MerchantController@showManagerSettings");
    Route::post('/manager/logout', "AuthController@showManagerSettings");

    Route::post('/manager/producten/addProduct', "MerchantController@addProduct");
    Route::put('/manager/producten/toggleOrderable', "MerchantController@toggleOrderable");
    Route::put('/manager/producten/updateProduct', "MerchantController@updateProduct");
    Route::delete('/manager/producten/deleteProduct', "MerchantController@deleteProduct");

    Route::put('/manager/orders/confirmOrder', "MerchantController@confirmOrder");
    Route::put('/manager/orders/denyOrder', "MerchantController@denyOrder");
    
    Route::put('/manager/settings/updateTakeawayHours', "MerchantController@updateTakeawayHours");
    Route::put('/manager/settings/updateDeliveryHours', "MerchantController@updateDeliveryHours");
    Route::put('/manager/settings/updateBanner', "MerchantController@updateBanner");
    Route::put('/manager/settings/updateLogo', "MerchantController@updateLogo");
    Route::put('/manager/settings/updateMessage', "MerchantController@updateMessage");
    Route::put('/manager/settings/updateMinimumWaitTimeForTakeaway', "MerchantController@updateMinimumWaitTimeForTakeaway");
    Route::put('/manager/settings/updateMinimumWaitTimeForDelivery', "MerchantController@updateMinimumWaitTimeForDelivery");

    Route::get('/manager/settings/orderPossibleInSchedule', "MerchantController@orderPossibleInSchedule");

});

Route::get('/confirm-email/{verificationCode}', "AuthController@confirmEmail");


Route::get('/sendBatchOfEmails', "AuthController@sendBatchOfEmails");