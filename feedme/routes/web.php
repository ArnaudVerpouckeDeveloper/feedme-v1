<?php

use Illuminate\Support\Facades\Route;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Mail;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orders', function () {
    return view('orders');
});


Route::get('/confirmEmail', function () {
    $user = App\User::find(3);

    return new App\Mail\ConfirmEmail($user);
});

Route::get('/manager/helloWorld', function(){
    return view("managerDashboard");
});

Route::get('/manager/login', "MerchantController@login");
Route::get('/manager/dashboard', "MerchantController@showManagerDashboard");
Route::get('/manager/orders', "MerchantController@showManagerOrders");
Route::get('/manager/producten', "MerchantController@showManagerProducts");
Route::get('/manager/instellingen', "MerchantController@showManagerSettings");

Route::post('/manager/producten/addProduct', "MerchantController@addProduct");
Route::put('/manager/producten/toggleOrderable', "MerchantController@toggleOrderable");
Route::put('/manager/producten/updateProduct', "MerchantController@updateProduct");
Route::delete('/manager/producten/deleteProduct', "MerchantController@deleteProduct");


Route::get("/testmail", function(){
    /*
    try {
        $security = ($request->get('mail_encryption') != 'None') ? request()->get('mail_encryption') : null;
        $transport = new \Swift_SmtpTransport($request->get('mail_host'), $request->get('mail_port'), $security);
        $transport->setUsername($request->get('mail_username'));
        $transport->setPassword($request->get('mail_password'));
        $mailer = new \Swift_Mailer($transport);
        $mailer->getTransport()->start();
       }
       catch (\Swift_TransportException $e) {
        return redirect('mailSettings')->withInput()->with(array('message'=>'Can not connect to SMTP with given credentials.'));
       }
       */
      $user = App\User::find(2);

          Mail::to("arnaud.verpoucke@student.howest.be")->send(new ConfirmEmail($user));
      
    });



Route::get('/confirm-email/{verificationCode}',"AuthController@confirmEmail");