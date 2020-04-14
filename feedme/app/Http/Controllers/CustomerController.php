<?php

namespace App\Http\Controllers;
use App\Product;
use App\Order;
use App\Merchant;
use Auth;
use Illuminate\Http\Request;
use App\Traits\SharedMerchantTrait;
use App\Mail\ConfirmOrder;
use App\Mail\WebForm;
use Mail;
use DateTime;
use Exception;

class CustomerController extends Controller
{
    use SharedMerchantTrait;

    public function showMerchantShop($merchantApiName){
        $merchant = Merchant::where("apiName", $merchantApiName)->first();
        if ($merchant == null){
            return view("errors.404");
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

        $merchantObject->minimumWaitTime_takeaway = $merchant->minimumWaitTime_takeaway;
        $merchantObject->minimumWaitTime_delivery = $merchant->minimumWaitTime_delivery;

        $merchantObject->deliveryMethod_takeaway = $merchant->deliveryMethod_takeaway;
        $merchantObject->deliveryMethod_delivery = $merchant->deliveryMethod_delivery;

        $merchantObject->merchantPhone = $merchant->merchantPhone;
        $merchantObject->address_street = $merchant->address_street;
        $merchantObject->address_number = $merchant->address_number;
        $merchantObject->address_zip = $merchant->address_zip;
        $merchantObject->address_city = $merchant->address_city;
        $merchantObject->bannerFileName = $merchant->bannerFileName;
        $merchantObject->logoFileName = $merchant->logoFileName;



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


        
        try {

            if (!(strtotime(auth()->user()->customer->orders()->orderBy("created_at","desc")->first()->created_at) < strtotime("-30 seconds"))){
                return response()->json("another order was recently sent", 406);
            }
            
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
                return response()->json("order not possible in shedule", 406);
            }
    
    
            $order->requestedTime = DateTime::createFromFormat('H:i', $request->requestedTime);
            
    
            if ($this->productIdsAreValid($request->productIds, $merchant)){
                if($this->orderPossibleInSchedule($merchant, $request->deliveryMethod, $request->requestedTime )){
                    $merchant->orders()->save($order);
                    auth()->user()->customer->orders()->save($order);
    
                    $totalPrice = 0;
                    foreach ($request->productIds as $productId){
                        $product = Product::find($productId);
                        $order->products()->attach($product);
                        $totalPrice = $totalPrice + $product->price;
                    }
    
                    $order->totalPrice = $totalPrice;
                    $order->save();
    
                    Mail::to(auth()->user()->email)->send(new confirmOrder($order));//todo: this could give an error, check if it shouldn't need to be auth("api")
                    return response()->json("ok");
                }
                else{
                    return response()->json("order not possible in shedule", 406);
                }
            }
            else{
                return response()->json("invalid products", 406);
            }
    
        } catch (Exception $e) {
            $order->delete();
            return response()->json($e->getMessage(), 406);
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
            if ($product == null || $product->merchant->id != $merchant->id || !$product->orderable ){
                return false; 
            }
        }
        return true;
    }


    function sendContactForm(Request $request){
        $validatedData = $request->validate([
            'fullName' => 'required|string|min:1',
            'email' => 'required|email',
            'message' => 'required|min:1'
        ]);   

        Mail::to("info@speedmeal.be")->send(new webForm($validatedData));
        return response()->json("ok");
    }
}
