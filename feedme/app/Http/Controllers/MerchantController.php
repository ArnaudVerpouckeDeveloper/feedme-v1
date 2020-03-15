<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;



class MerchantController extends Controller
{
    function protected(Request $request){
        dd(auth()->user());
        return $request;
    }


    function addProduct(Request $request){

    }

    function getAllProducts(){
        
    }

}
