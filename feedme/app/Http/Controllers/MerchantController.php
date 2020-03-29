<?php

namespace App\Http\Controllers;

use App\Merchant;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Product;


class MerchantController extends Controller
{
    function protected(Request $request){
        dd(auth()->user());
        return $request;
    }

    function getAllMerchants(Request $request){
        return Merchant::all();
    }

    function addProduct(Request $request){
        
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'available' => 'required'
        ]);
        

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = floatval(str_replace(',', '.', str_replace('.', '', $request->price)));
        $product->available = $request->available;

        auth()->user()->merchant->products()->save($product);

        return response()->json($product,201);
    }

    function getAllProducts(){
        return auth()->user()->products()->get();
    }

    function getAllOrders(){
        return auth()->user()->orders()->get();
    }


    function updateLogo(Request $request){
        $file = $request->file("logo");
        $fileName = "logo-".auth()->user()->merchant->apiName.".".$file->getClientOriginalExtension();
        $path = $file->move(public_path("/merchantLogos/"), $fileName);
        auth()->user()->merchant->update(['logoFileName' => $fileName]);
    }

    function updateBanner(Request $request){
        $file = $request->file("banner");
        $fileName = "banner-".auth()->user()->merchant->apiName.".".$file->getClientOriginalExtension();
        $path = $file->move(public_path("/merchantBanners/"), $fileName);
        auth()->user()->merchant->update(['bannerFileName' => $fileName]);
    }

}
