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
use App\Mail\NewOrderNotification;
use Mail;
use DateTime;
use Exception;

class CustomerController extends Controller
{
    use SharedMerchantTrait;

    /* deprecated
    public function showMerchantShop($merchantApiName){
        $merchant = Merchant::where("apiName", $merchantApiName)->first();
        if ($merchant == null){
            //return redirect()->route('anythingElse',['query' => $merchantApiName]);
            //return redirect()->route('index',['query' => $merchantApiName]);
            return redirect($merchantApiName);

            //return view("errors.404");
        }
        else{
            $merchant->update(["amountOfVisitors" => $merchant->amountOfVisitors +1]);
            return redirect("/restaurant/".$merchant->id);
        }
    }
    */



    function getAllMerchants(){
        $allMerchantsRaw = Merchant::all();
        $allMerchantsToReturn = [];
        foreach ($allMerchantsRaw as $merchant) {
            $fetchedMerchant = $this->getMerchant($merchant->id, false);
            if ($fetchedMerchant != null){
                $allMerchantsToReturn[] = $fetchedMerchant;
            }
        }
        return $allMerchantsToReturn;
    }



    function getMerchant($merchantId, $returnAsJsonResponse = true){
        $merchant = Merchant::find($merchantId);
        if ($merchant == null){
            exit();
        }
        if ($merchant->hideMerchantFromSpeedmeal){
            return null;
        }
        $merchantObject = new \stdClass;
        $merchantObject->name = $merchant->name;
        $merchantObject->apiName = $merchant->apiName;
        $merchantObject->id = $merchant->id;
        $merchantObject->message = $merchant->message;

        $merchantObject->minimumOrderValue = $merchant->minimumOrderValue;
        $merchantObject->deliveryCost = $merchant->deliveryCost;

        $merchantObject->minimumWaitTime_takeaway = $merchant->minimumWaitTime_takeaway;
        $merchantObject->minimumWaitTime_delivery = $merchant->minimumWaitTime_delivery;

        /* deprecated
        $merchantObject->deliveryMethod_takeaway = $merchant->deliveryMethod_takeaway;
        $merchantObject->deliveryMethod_delivery = $merchant->deliveryMethod_delivery;
        */

        $merchantObject->merchantPhone = $merchant->merchantPhone;
        $merchantObject->address_street = $merchant->address_street;
        $merchantObject->address_number = $merchant->address_number;
        $merchantObject->address_zip = $merchant->address_zip;
        $merchantObject->address_city = $merchant->address_city;
        $merchantObject->bannerFileName = $merchant->bannerFileName;
        $merchantObject->logoFileName = $merchant->logoFileName;



        $merchantObject->possibleTimes = $this->getPossibleRequestTimes($merchant);
        //return response()->json($this->getPossibleRequestTimes($merchant));

        $merchantObject->products = $merchant->products()->where("orderable", true)->get();

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


            
            $merchantObject->productCategories = $merchant->productCategories()->select("id","name")->get();




            $merchantObject->infoDeliveryPossible = $this->merchantOrderMethodPossibleToday($merchant, "delivery");
            $merchantObject->infoTakeawayPossible = $this->merchantOrderMethodPossibleToday($merchant, "takeaway");
            $merchantObject->infoCurrentlyOpen = $this->merchantIsCurrentlyOpen($merchant);




            if ($returnAsJsonResponse){
                return response()->json($merchantObject,200);
            }
            else{
                return $merchantObject;
            }
    }
    
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
            if(auth()->user()->customer->orders->count() != 0){
                if (!(strtotime(auth()->user()->customer->orders()->orderBy("created_at","desc")->first()->created_at) < strtotime("-30 seconds"))){
                    return response()->json("another order was recently sent", 406);
                }
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
            $order->details = $request->message;

            $allProductIds = [];
            foreach ($request->products as $product) {
                for($i = 0; $i < $product["count"]; $i++){
                    array_push($allProductIds, $product["id"]);
                }
            }


    
            if ($this->productIdsAreValid($allProductIds, $merchant)){

                if($this->orderPossibleInSchedule($merchant, $request->deliveryMethod, $request->requestedTime )){

                    
                    $merchant->orders()->save($order);
                    auth()->user()->customer->orders()->save($order);

                    $totalPrice = 0;
                    foreach ($allProductIds as $productId){
                        $product = Product::find($productId);
                        $order->products()->attach($product);
                        $totalPrice = $totalPrice + $product->price;
                    }

                    if ($totalPrice < $merchant->minimumOrderValue){
                        throw new Exception('total price from order is below minimum value');
                    }

                    
    
    
                    $order->totalPrice = $totalPrice;
                    $order->save();
    

                    Mail::to(auth()->user()->email)->send(new confirmOrder($order));//todo: this could give an error, check if it shouldn't need to be auth("api")
                    if ($merchant->receiveEmailsForNewOrders){
                        Mail::to($merchant->user->email)->send(new newOrderNotification($order));
                    }

                    return response()->json("ok");
                }
                else{
                    //return response()->json("order not possible in shedule", 406);
                    throw new Exception('order not possible in shedule');
                }
            }
            else{
                //return response()->json("invalid products", 406);
                throw new Exception('invalid products');
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
            if ($product == null){
                return false; 
            }
            if ($product->merchant->id != $merchant->id){
                return false;
            }
            if (!$product->orderable){
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
