<?php

use Illuminate\Support\Facades\Route;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ConfirmOrder;

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

Route::get("/", function(){return view("index");});
Route::get("/restaurants", function(){return view("index");});
Route::get("/over", function(){return view("index");});
Route::get("/faq", function(){return view("index");});
Route::get("/contact", function(){return view("index");});
Route::get("/aanmelden", function(){return view("index");});
Route::get("/registreer", function(){return view("index");});
Route::get("/voorwaarden", function(){return view("index");});

Route::get('email/verify', "AuthController@verifyEmailNotice")->name('verification.notice');
Route::get("/admin/login", function () {return view("merchantLogin");})->name("login");
Route::post("/admin/login", "AuthController@logMerchantIn");
Route::get("/admin/registreren", function () {return view("merchantRegister");});
Route::post("/admin/registreren", "AuthController@registerMerchant");
Route::get("/admin/afmelden", "AuthController@logMerchantOut");

Route::group([
    'middleware' => ['auth', "auth.merchant", "verified"],
], function ($router) {
    Route::get('/admin/dashboard', "MerchantController@showManagerDashboard");
    Route::get('/admin/orders', "MerchantController@showManagerOrders");
    Route::get('/admin/producten', "MerchantController@showManagerProducts");
    Route::get('/admin/instellingen', "MerchantController@showManagerSettings");
    Route::post('/admin/logout', "AuthController@showManagerSettings");

    Route::post('/admin/producten/addProduct', "MerchantController@addProduct");
    Route::put('/admin/producten/toggleOrderable', "MerchantController@toggleOrderable");
    Route::put('/admin/producten/updateProduct', "MerchantController@updateProduct");
    Route::delete('/admin/producten/deleteProduct', "MerchantController@deleteProduct");

    Route::put('/admin/orders/acceptOrder', "MerchantController@acceptOrder");
    Route::put('/admin/orders/denyOrder', "MerchantController@denyOrder");
    Route::put('/admin/orders/addTimeToOrder_15', "MerchantController@addTimeToOrder_15");
    Route::put('/admin/orders/addTimeToOrder_30', "MerchantController@addTimeToOrder_30");
    Route::put('/admin/orders/addTimeToOrder_60', "MerchantController@addTimeToOrder_60");
    Route::put('/admin/orders/completeOrder', "MerchantController@completeOrder");

    Route::put('/admin/settings/updateTakeawayHours', "MerchantController@updateTakeawayHours");
    Route::put('/admin/settings/updateDeliveryHours', "MerchantController@updateDeliveryHours");
    Route::put('/admin/settings/updateBanner', "MerchantController@updateBanner");
    Route::put('/admin/settings/updateLogo', "MerchantController@updateLogo");
    Route::put('/admin/settings/updateMessage', "MerchantController@updateMessage");
    Route::put('/admin/settings/updateMinimumWaitTimeForTakeaway', "MerchantController@updateMinimumWaitTimeForTakeaway");
    Route::put('/admin/settings/updateMinimumWaitTimeForDelivery', "MerchantController@updateMinimumWaitTimeForDelivery");

    Route::get('/admin/settings/orderPossibleInSchedule', "MerchantController@orderPossibleInSchedule");
});

Route::get('/confirm-email/{verificationCode}', "AuthController@confirmEmail");
Route::get('/sendBatchOfEmails', "AuthController@sendBatchOfEmails");
Route::get("/{merchantApiName}", "CustomerController@showMerchantShop");
Route::post("/sendContactForm", "CustomerController@sendContactForm");