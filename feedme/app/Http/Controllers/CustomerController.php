<?php

namespace App\Http\Controllers;
use App\Product;
use App\Order;
use App\Merchant;
use Auth;
use Illuminate\Http\Request;
use App\Traits\SharedMerchantTrait;
use App\Mail\ConfirmOrder;
use Mail;

class CustomerController extends Controller
{
    use SharedMerchantTrait;

    public function showMerchantShop($merchantApiName){
        $merchant = Merchant::where("apiName", $merchantApiName)->first();
        if ($merchant == null){
            exit();
        }
        else{
            $merchant->update(["amountOfVisitors" => $merchant->amountOfVisitors +1]);
            //return redirect("/milat-zijn-url-van-de-shop");
            return "here comes the redirect to the frontend from milat";
        }
    }

    function getMerchant($merchantId){
        $merchant = Merchant::find($merchantId);
        if ($merchant == null){
            exit();
        }
        $merchantObject = new \stdClass;
        $merchantObject->name = $merchant->name;
        $merchantObject->id = $merchant->id;
        /* DEPRECATED, schedule should be used now
        $merchantObject->deliveryMethod_takeaway = $merchant->deliveryMethod_takeaway;
        $merchantObject->deliveryMethod_delivery = $merchant->deliveryMethod_delivery;
        */
        $merchantObject->minimumWaitTime_takeaway = $merchant->minimumWaitTime_takeaway;
        $merchantObject->minimumWaitTime_delivery = $merchant->minimumWaitTime_delivery;

        $merchantObject->possibleTimes = $this->getPossibleRequestTimes($merchant);

        $merchantObject->products = $merchant->products()->get();

        $merchantObject->opening_hours = [
            "takeaway" => [
                0 => [
                    "from_1" => $merchant->takeaway_monday_from_1,
                    "till_1" => $merchant->takeaway_monday_till_1,
                    "from_2" => $merchant->takeaway_monday_from_2,
                    "till_2" => $merchant->takeaway_monday_till_2
                ],
                1 => [
                    "from_1" => $merchant->takeaway_tuesday_from_1,
                    "till_1" => $merchant->takeaway_tuesday_till_1,
                    "from_2" => $merchant->takeaway_tuesday_from_2,
                    "till_2" => $merchant->takeaway_tuesday_till_2
                ],
                2 => [
                    "from_1" => $merchant->takeaway_wednesday_from_1,
                    "till_1" => $merchant->takeaway_wednesday_till_1,
                    "from_2" => $merchant->takeaway_wednesday_from_2,
                    "till_2" => $merchant->takeaway_wednesday_till_2
                ],
                3 => [
                    "from_1" => $merchant->takeaway_thursday_from_1,
                    "till_1" => $merchant->takeaway_thursday_till_1,
                    "from_2" => $merchant->takeaway_thursday_from_2,
                    "till_2" => $merchant->takeaway_thursday_till_2
                ],
                4 => [
                    "from_1" => $merchant->takeaway_friday_from_1,
                    "till_1" => $merchant->takeaway_friday_till_1,
                    "from_2" => $merchant->takeaway_friday_from_2,
                    "till_2" => $merchant->takeaway_friday_till_2
                ],
                5 => [
                    "from_1" => $merchant->takeaway_saturday_from_1,
                    "till_1" => $merchant->takeaway_saturday_till_1,
                    "from_2" => $merchant->takeaway_saturday_from_2,
                    "till_2" => $merchant->takeaway_saturday_till_2
                ],
                6 => [
                    "from_1" => $merchant->takeaway_sunday_from_1,
                    "till_1" => $merchant->takeaway_sunday_till_1,
                    "from_2" => $merchant->takeaway_sunday_from_2,
                    "till_2" => $merchant->takeaway_sunday_till_2
                ]
            ], 
            "delivery" => [
                0 => [
                    "from_1" => $merchant->delivery_monday_from_1,
                    "till_1" => $merchant->delivery_monday_till_1,
                    "from_2" => $merchant->delivery_monday_from_2,
                    "till_2" => $merchant->delivery_monday_till_2
                ],
                1 => [
                    "from_1" => $merchant->delivery_tuesday_from_1,
                    "till_1" => $merchant->delivery_tuesday_till_1,
                    "from_2" => $merchant->delivery_tuesday_from_2,
                    "till_2" => $merchant->delivery_tuesday_till_2
                ],
                2 => [
                    "from_1" => $merchant->delivery_wednesday_from_1,
                    "till_1" => $merchant->delivery_wednesday_till_1,
                    "from_2" => $merchant->delivery_wednesday_from_2,
                    "till_2" => $merchant->delivery_wednesday_till_2
                ],
                3 => [
                    "from_1" => $merchant->delivery_thursday_from_1,
                    "till_1" => $merchant->delivery_thursday_till_1,
                    "from_2" => $merchant->delivery_thursday_from_2,
                    "till_2" => $merchant->delivery_thursday_till_2
                ],
                4 => [
                    "from_1" => $merchant->delivery_friday_from_1,
                    "till_1" => $merchant->delivery_friday_till_1,
                    "from_2" => $merchant->delivery_friday_from_2,
                    "till_2" => $merchant->delivery_friday_till_2
                ],
                5 => [
                    "from_1" => $merchant->delivery_saturday_from_1,
                    "till_1" => $merchant->delivery_saturday_till_1,
                    "from_2" => $merchant->delivery_saturday_from_2,
                    "till_2" => $merchant->delivery_saturday_till_2
                ],
                6 => [
                    "from_1" => $merchant->delivery_sunday_from_1,
                    "till_1" => $merchant->delivery_sunday_till_1,
                    "from_2" => $merchant->delivery_sunday_from_2,
                    "till_2" => $merchant->delivery_sunday_till_2
                ]]
            ];


        return response()->json($merchantObject,200);
    }
    //
    function placeOrder(Request $request){
        if(!$this->merchantIdExists($request->merchantId)){
            exit();
        }
        
        $merchant = Merchant::find($request->merchantId);
        $order = new Order();



        /*
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
        */


        if ($this->orderPossibleInSchedule($merchant, $request->deliveryMethod, $request->requestedTime)){
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

                Mail::to(auth()->user()->email)->send(new confirmOrder($order));
            }
        }
        else{
            exit();
        }
        
    }

/*  DEPRECATED
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
*/

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
