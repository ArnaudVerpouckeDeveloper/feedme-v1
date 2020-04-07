<?php

namespace App\Http\Controllers;
use App\Product;
use App\Order;
use App\Merchant;
use Auth;
use Illuminate\Http\Request;
use App\Traits\SharedMerchantTrait;

class CustomerController extends Controller
{
    use SharedMerchantTrait;

    function getMerchant($merchantId){
        $merchant = Merchant::find($merchantId);
        if ($merchant == null){
            exit();
        }
        $merchantObject = new \stdClass;
        $merchantObject->name = $merchant->name;
        $merchantObject->name = $merchant->id;
        $merchantObject->deliveryMethod_takeaway = $merchant->deliveryMethod_takeaway;
        $merchantObject->deliveryMethod_delivery = $merchant->deliveryMethod_delivery;
        $merchantObject->products = $merchant->products()->get();


        return response()->json($merchantObject,200);
    }
    //
    function placeOrder(Request $request){
        if(!$this->merchantIdExists($request->merchantId)){
            exit();
        }
        
        $merchant = Merchant::find($request->merchantId);
        $order = new Order();



        if ($this->isValidDeliveryMethod($merchant, $request->deliveryMethod)){
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
        else{
            exit();
        }

        $order->requestedTime = $request->requestedTime;
        
        if ($this->productIdsAreValid($request->productIds, $merchant)){
            if($this->orderPossibleInSchedule($merchant, $request->deliveryMethod, $request->requestedTime )){
                $merchant->orders()->save($order);
                auth()->user()->customer->orders()->save($order);

                foreach ($request->productIds as $productId){
                    $order->products()->attach(Product::find($productId));
                }
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
        foreach($productIds as $productId){
            $product = Product::find($productId);
            if (
                $product == null 
                || $product->merchant->id != $merchant->id
                || !$product->available 
                ){
                return false; 
            }
        }
        return true;
    }
}
