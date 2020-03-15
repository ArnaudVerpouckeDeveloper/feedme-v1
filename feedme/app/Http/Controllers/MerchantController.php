<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Product;


class MerchantController extends Controller
{
    function protected(Request $request){
        dd(auth()->user());
        return $request;
    }


    function addProduct(Request $request){
        
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'available' => 'required'
        ]);
        

        $product = new Product();
        $product->name = $request->name;
        $product->price = floatval(str_replace(',', '.', str_replace('.', '', $request->price)));
        $product->available = $request->available;

        auth()->user()->products()->save($product);
        return "added";
    }

    function getAllProducts(){
        
    }

}
