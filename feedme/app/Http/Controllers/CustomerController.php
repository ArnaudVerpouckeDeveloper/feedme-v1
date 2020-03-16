<?php

namespace App\Http\Controllers;
use App\Product;
use App\Order;
use App\Merchant;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    function placeOrder(Request $request){
        if(!merchantIdExists($request->merchantId)){
            exit();
        }
        
        $merchant = Merchant::find($request->merchantId);
        $order = new Order();

        if (isValidDeliveryMethod($merchant, $request->deliveryMethod)){
            $order->deliveryMethod = $request->deliveryMethod;
            if ($request->deliveryMethod == "delivery"){
                $order->addressStreet = $request->addressStreet;
                $order->addressNumber = $request->addressNumber;
                $order->addressZipCode = $request->addressZipCode;
                $order->addressCity = $request->addressCity;
                $order->deliveryMethod = "delivery";
            }
            else{
                $order->deliveryMethod = "takeaway";
            }
        }
        
        if (productIdsAreValid($request->productIds, $merchant)){
            
            $productsInOrder = [];
            $merchant->orders()->save($order);
            $customer->orders()->save($order);

            foreach ($productIdsInOrder as $productId){
                $order->products()->attach(Product::find($productId));
            }

        }
        else{
            exit();
        }
        
    }


    function isValidDeliveryMethod($merchant, $method){
        switch ($method) {
            case 'delivery':
                if ($merchant->deliveryMethod_delivery){
                    return true;
                }
                break;
            case 'takeaway':
                if ($merchant->deliveryMethod_takeaway){
                    return true;
                }
                break;
            default:
                break;
        }
        return false;
    }

    function merchantIdExists($id){
        if (Merchant::find($id) != null){
            return true;
        }
        else{
            return false;
        }
    }

    function productIdsAreValid($productIds, $merchant){
        foreach(productIds as $productId){
            $product = Product::find($productId);
            if (
                $product == null 
                || $product->merchant()->id != $merchant->id
                || !$product->available 
                ){
                return false; 
            }
        }
        return true;
    }
}
