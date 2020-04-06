<?php

namespace App\Http\Controllers;

use App\Merchant;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Product;
use App\User;


class MerchantController extends Controller
{
    function protected(Request $request){
        dd(auth()->user());
        return $request;
    }

    function getAllMerchants(Request $request){
        return Merchant::all();
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














    function showManagerDashboard(Request $request){
        //$merchant = auth()->user()->merchant;
        $merchant = Merchant::first();
        $banana = auth()->user();
        return view("managerDashboard")->with("merchant", $merchant)->with("banana", $banana);
    }

    function showManagerOrders(Request $request){
        //$merchant = auth()->user()->merchant;
        $merchant = Merchant::first();
        return view("managerOrders")->with("merchant", $merchant);
    }

    function showManagerProducts(Request $request){
        //$merchant = auth()->user()->merchant;
        $merchant = Merchant::first();
        $auth = auth();
        return view("managerProducts")->with("merchant", $merchant)->with("auth", $auth);
    }

    function showManagerSettings(Request $request){
        //$merchant = auth()->user()->merchant;
        $merchant = Merchant::first();
        return view("managerSettings")->with("merchant", $merchant);
    }










    function addProduct(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|min:2',
            'price' => 'required|min:1'
        ]);        

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = floatval(str_replace(',', '.', str_replace('.', '', $request->price)));
        $product->available = $request->available;

        auth()->user()->merchant->products()->save($product);
        return back();
    }

    function toggleOrderable(Request $request){

        $product = auth()->user()->merchant->products->find($request->productId);
        $product->orderable = !$product->orderable;
        $product->save();
        return response()->json("ok");
    }

    function updateProduct(Request $request){
        $product = auth()->user()->merchant->products->find($request->productId);
        $product->name = $request->name;
        $product->price = str_replace(",",".",$request->price);
        $product->save();
        return response()->json("ok");
    }

    function deleteProduct(Request $request){
        $productToDelete = auth()->user()->merchant->products->find($request->productId);

        $orders = auth()->user()->merchant->orders;
        foreach ($orders as $order) {
            foreach($order->products as $product){
                if ($product->id == $productToDelete->id){
                    return response()->json("product found in orders");
                }
            }
        }
        $productToDelete->delete();
        return response()->json("ok");
    }

}
