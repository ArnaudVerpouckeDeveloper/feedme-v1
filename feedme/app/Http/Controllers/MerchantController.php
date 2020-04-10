<?php

namespace App\Http\Controllers;

use App\Mail\OrderHasBeenDelayed;
use App\Mail\OrderHasBeenDenied;
use App\Merchant;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Product;
use App\Rules\ScheduleTime;
use App\Rules\Price;
use App\User;
use Exception;
use DateTime;
use Mail;
use stdClass;
use App\Traits\SharedMerchantTrait;


class MerchantController extends Controller
{
    use SharedMerchantTrait;

    function protected(Request $request){
        dd(auth()->user());
        return $request;
    }

    function getAllMerchants(Request $request){
        $allMerchants = Merchant::all();
        foreach ($allMerchants as $merchant) {
            $merchant["availableTimes"] = $this->getPossibleRequestTimes($merchant);
        }
        return $allMerchants;
    }

    

    function getAllProducts(){
        return auth()->user()->products()->get();
    }

    function getAllOrders(){
        return auth()->user()->orders()->get();
    }


    function updateLogo(Request $request){
        $request->validate([
            'logo' => 'required|max:5000|image',
        ]);
        $file = $request->file("logo");
        $fileName = "logo-".auth()->user()->merchant->apiName.".".$file->getClientOriginalExtension();
        $path = $file->move(public_path("/merchantLogos/"), $fileName);
        auth()->user()->merchant->update(['logoFileName' => $fileName]);
        return redirect("/manager/instellingen");
    }

    function updateBanner(Request $request){
        $request->validate([
            'banner' => 'required|max:5000|image',
        ]);
        $file = $request->file("banner");
        $fileName = "banner-".auth()->user()->merchant->apiName.".".$file->getClientOriginalExtension();
        $path = $file->move(public_path("/merchantBanners/"), $fileName);
        auth()->user()->merchant->update(['bannerFileName' => $fileName]);
        return redirect("/manager/instellingen");
    }




    function updateMessage(Request $request){
        $request->validate([
            'message' => 'required'
        ]);
        auth()->user()->merchant->update(['message' => $request->message]);
        return redirect("/manager/instellingen");
    }













    function showManagerDashboard(Request $request){
        $merchant = auth()->user()->merchant;

        $amountOfProducts = $merchant->products()->where("orderable", true)->count();
        $amountOfOpenOrders = $merchant->orders()->where("completed",false)->count();
        $amountOfVisitors = $merchant->amountOfVisitors;

        $checklist = [];


        if(is_null($merchant->logoFileName)){
            array_push($checklist, ["instruction" => "Stel een logo in voor uw pagina.", "location" => "settings"]);
        }

        if($amountOfProducts < 5){
            array_push($checklist, ["instruction" => "Voeg minstens 5 (bestelbare) producten toe.", "location" => "products"]);
        }

        if(is_null($merchant->bannerFileName)){
            array_push($checklist, ["instruction" => "Stel een banner in voor uw pagina. Dit is een langwerpige foto en smal in hoogte, de banner komt bovenaan uw pagina te staan. Bij instellingen kan u alvast een idee krijgen welke vorm de banner moet hebben.", "location" => "settings"]);
        }

        if(!$merchant->hasSetTakeawayTimes){
            array_push($checklist, ["instruction" => "Stel de tijdstippen in waarop bestellingen afgehaald kunnen worden.", "location" => "settings"]);
        }

        if(!$merchant->hasSetDeliveryTimes){
            array_push($checklist, ["instruction" => "Stel de tijdstippen in waarop bestellingen geleverd kunnen worden.", "location" => "settings"]);
        }

        if(!$merchant->hasSetMinimumWaitTimeForTakeaway){
            array_push($checklist, ["instruction" => "Stel de minimale wachttijd in voor afhalingen.", "location" => "settings"]);
        }

        if(!$merchant->hasSetMinimumWaitTimeForDelivery){
            array_push($checklist, ["instruction" => "Stel de minimale wachttijd in voor leveringen.", "location" => "settings"]);
        }

        if($merchant->orders->count() == 0){
            array_push($checklist, ["instruction" => "Ontvang uw eerste order.", "location" => "orders"]);
        }

        if($merchant->orders->where("completed",true)->count() == 0){
            array_push($checklist, ["instruction" => "Werk uw eerste order af.", "location" => "orders"]);
        }
        
        $amountOfToDos = sizeof($checklist);
        $checklistObject = new stdClass();
        foreach ($checklist as $key => $value)
        {
            $checklistObject->$key = $value;
        }


        return view("managerDashboard")
        ->with("merchant", $merchant)
        ->with("amountOfProducts", $amountOfProducts)
        ->with("amountOfOpenOrders", $amountOfOpenOrders)
        ->with("amountOfVisitors", $amountOfVisitors)
        ->with("amountOfToDos", $amountOfToDos)
        ->with("checklist", $checklistObject);

    }

    function showManagerOrders(Request $request){
        $merchant = auth()->user()->merchant;
        return view("managerOrders")->with("merchant", $merchant);
    }

    function showManagerProducts(Request $request){
        $merchant = auth()->user()->merchant;
        return view("managerProducts")->with("merchant", $merchant);
    }

    function showManagerSettings(Request $request){
        $merchant = auth()->user()->merchant;
        return view("managerSettings")->with("merchant", $merchant);
    }






    function acceptOrder(Request $request){
        $order = auth()->user()->merchant->orders->find($request->orderId);
        $order->update(["accepted" => true]);
        return response()->json("ok");
    }


    function denyOrder(Request $request){
        $order = auth()->user()->merchant->orders->find($request->orderId);
        $order->update(["denied" => true]);
        Mail::to($order->customer->user->email)->send(new OrderHasBeenDenied($order));
        return response()->json("ok");
    }


    function completeOrder(Request $request){
        $order = auth()->user()->merchant->orders->find($request->orderId);
        $order->update(["completed" => true]);
        return response()->json("ok");
    }





    function addProduct(Request $request){
        $request->validate([
            'name' => 'required|min:2',
            'price' => ['required','min:0'],
            'description' => 'nullable'
        ]);        

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = floatval(str_replace(',', '.', str_replace('.', '', $request->price)));

        auth()->user()->merchant->products()->save($product);
        return response()->json("ok");
    }

    function toggleOrderable(Request $request){

        $product = auth()->user()->merchant->products->find($request->productId);
        $product->orderable = !$product->orderable;
        $product->save();
        return response()->json("ok");
    }

    function updateProduct(Request $request){
        $request->price = str_replace(",",".",$request->price);
        $request->validate([
            'name' => 'required|min:2',
            'price' => ['required', new Price]
        ]);
        $product = auth()->user()->merchant->products->find($request->productId);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
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







    
    function updateMinimumWaitTimeForTakeaway(Request $request){
        $request->validate([
            'minimumWaitTime_takeaway' => ['required', new ScheduleTime]
        ]);        

        $merchant = auth()->user()->merchant()->update([
            "minimumWaitTime_takeaway" => $request->minimumWaitTime_takeaway,
            "hasSetMinimumWaitTimeForTakeaway" => true]);
        return redirect("/manager/instellingen");
    }

    function updateMinimumWaitTimeForDelivery(Request $request){
        $request->validate([
            'minimumWaitTime_delivery' => ['required', new ScheduleTime]
        ]);        

        $merchant = auth()->user()->merchant()->update([
            "minimumWaitTime_delivery" => $request->minimumWaitTime_delivery,
            "hasSetMinimumWaitTimeForDelivery" => true]);
        return redirect("/manager/instellingen");
    }


    function updateTakeawayHours(Request $request){
        
        $request->validate([
            'takeaway_monday_from_1' => ['required', new ScheduleTime],
            'takeaway_monday_till_1' => ['required', new ScheduleTime],
            'takeaway_monday_from_2' => ['required', new ScheduleTime],
            'takeaway_monday_till_2' => ['required', new ScheduleTime],
            'takeaway_tuesday_from_1' => ['required', new ScheduleTime],
            'takeaway_tuesday_till_1' => ['required', new ScheduleTime],
            'takeaway_tuesday_from_2' => ['required', new ScheduleTime],
            'takeaway_tuesday_till_2' => ['required', new ScheduleTime],
            'takeaway_wednesday_from_1' => ['required', new ScheduleTime],
            'takeaway_wednesday_till_1' => ['required', new ScheduleTime],
            'takeaway_wednesday_from_2' => ['required', new ScheduleTime],
            'takeaway_wednesday_till_2' => ['required', new ScheduleTime],
            'takeaway_thursday_from_1' => ['required', new ScheduleTime],
            'takeaway_thursday_till_1' => ['required', new ScheduleTime],
            'takeaway_thursday_from_2' => ['required', new ScheduleTime],
            'takeaway_thursday_till_2' => ['required', new ScheduleTime],
            'takeaway_friday_from_1' => ['required', new ScheduleTime],
            'takeaway_friday_till_1' => ['required', new ScheduleTime],
            'takeaway_friday_from_2' => ['required', new ScheduleTime],
            'takeaway_friday_till_2' => ['required', new ScheduleTime],
            'takeaway_saturday_from_1' => ['required', new ScheduleTime],
            'takeaway_saturday_till_1' => ['required', new ScheduleTime],
            'takeaway_saturday_from_2' => ['required', new ScheduleTime],
            'takeaway_saturday_till_2' => ['required', new ScheduleTime],
            'takeaway_sunday_from_1' => ['required', new ScheduleTime],
            'takeaway_sunday_till_1' => ['required', new ScheduleTime],
            'takeaway_sunday_from_2' => ['required', new ScheduleTime],
            'takeaway_sunday_till_2' => ['required', new ScheduleTime]
            ]);
        

        $merchant = auth()->user()->merchant();
        $merchant->update([
            'takeaway_monday_from_1' => $request->takeaway_monday_from_1,
            'takeaway_monday_till_1' => $request->takeaway_monday_till_1,
            'takeaway_monday_from_2' => $request->takeaway_monday_from_2,
            'takeaway_monday_till_2' => $request->takeaway_monday_till_2,
            'takeaway_tuesday_from_1' => $request->takeaway_tuesday_from_1,
            'takeaway_tuesday_till_1' => $request->takeaway_tuesday_till_1,
            'takeaway_tuesday_from_2' => $request->takeaway_tuesday_from_2,
            'takeaway_tuesday_till_2' => $request->takeaway_tuesday_till_2,
            'takeaway_wednesday_from_1' => $request->takeaway_wednesday_from_1,
            'takeaway_wednesday_till_1' => $request->takeaway_wednesday_till_1,
            'takeaway_wednesday_from_2' => $request->takeaway_wednesday_from_2,
            'takeaway_wednesday_till_2' => $request->takeaway_wednesday_till_2,
            'takeaway_thursday_from_1' => $request->takeaway_thursday_from_1,
            'takeaway_thursday_till_1' => $request->takeaway_thursday_till_1,
            'takeaway_thursday_from_2' => $request->takeaway_thursday_from_2,
            'takeaway_thursday_till_2' => $request->takeaway_thursday_till_2,
            'takeaway_friday_from_1' => $request->takeaway_friday_from_1,
            'takeaway_friday_till_1' => $request->takeaway_friday_till_1,
            'takeaway_friday_from_2' => $request->takeaway_friday_from_2,
            'takeaway_friday_till_2' => $request->takeaway_friday_till_2,
            'takeaway_saturday_from_1' => $request->takeaway_saturday_from_1,
            'takeaway_saturday_till_1' => $request->takeaway_saturday_till_1,
            'takeaway_saturday_from_2' => $request->takeaway_saturday_from_2,
            'takeaway_saturday_till_2' => $request->takeaway_saturday_till_2,
            'takeaway_sunday_from_1' => $request->takeaway_sunday_from_1,
            'takeaway_sunday_till_1' => $request->takeaway_sunday_till_1,
            'takeaway_sunday_from_2' => $request->takeaway_sunday_from_2,
            'takeaway_sunday_till_2' => $request->takeaway_sunday_till_2,
            "hasSetTakeawayTimes" => true
            ]);


        return redirect("/manager/instellingen");
    }


    
    function updateDeliveryHours(Request $request){
        
        $request->validate([
            'delivery_monday_from_1' => ['required', new ScheduleTime],
            'delivery_monday_till_1' => ['required', new ScheduleTime],
            'delivery_monday_from_2' => ['required', new ScheduleTime],
            'delivery_monday_till_2' => ['required', new ScheduleTime],
            'delivery_tuesday_from_1' => ['required', new ScheduleTime],
            'delivery_tuesday_till_1' => ['required', new ScheduleTime],
            'delivery_tuesday_from_2' => ['required', new ScheduleTime],
            'delivery_tuesday_till_2' => ['required', new ScheduleTime],
            'delivery_wednesday_from_1' => ['required', new ScheduleTime],
            'delivery_wednesday_till_1' => ['required', new ScheduleTime],
            'delivery_wednesday_from_2' => ['required', new ScheduleTime],
            'delivery_wednesday_till_2' => ['required', new ScheduleTime],
            'delivery_thursday_from_1' => ['required', new ScheduleTime],
            'delivery_thursday_till_1' => ['required', new ScheduleTime],
            'delivery_thursday_from_2' => ['required', new ScheduleTime],
            'delivery_thursday_till_2' => ['required', new ScheduleTime],
            'delivery_friday_from_1' => ['required', new ScheduleTime],
            'delivery_friday_till_1' => ['required', new ScheduleTime],
            'delivery_friday_from_2' => ['required', new ScheduleTime],
            'delivery_friday_till_2' => ['required', new ScheduleTime],
            'delivery_saturday_from_1' => ['required', new ScheduleTime],
            'delivery_saturday_till_1' => ['required', new ScheduleTime],
            'delivery_saturday_from_2' => ['required', new ScheduleTime],
            'delivery_saturday_till_2' => ['required', new ScheduleTime],
            'delivery_sunday_from_1' => ['required', new ScheduleTime],
            'delivery_sunday_till_1' => ['required', new ScheduleTime],
            'delivery_sunday_from_2' => ['required', new ScheduleTime],
            'delivery_sunday_till_2' => ['required', new ScheduleTime]
            ]);
        

        $merchant = auth()->user()->merchant();
        $merchant->update([
            'delivery_monday_from_1' => $request->delivery_monday_from_1,
            'delivery_monday_till_1' => $request->delivery_monday_till_1,
            'delivery_monday_from_2' => $request->delivery_monday_from_2,
            'delivery_monday_till_2' => $request->delivery_monday_till_2,
            'delivery_tuesday_from_1' => $request->delivery_tuesday_from_1,
            'delivery_tuesday_till_1' => $request->delivery_tuesday_till_1,
            'delivery_tuesday_from_2' => $request->delivery_tuesday_from_2,
            'delivery_tuesday_till_2' => $request->delivery_tuesday_till_2,
            'delivery_wednesday_from_1' => $request->delivery_wednesday_from_1,
            'delivery_wednesday_till_1' => $request->delivery_wednesday_till_1,
            'delivery_wednesday_from_2' => $request->delivery_wednesday_from_2,
            'delivery_wednesday_till_2' => $request->delivery_wednesday_till_2,
            'delivery_thursday_from_1' => $request->delivery_thursday_from_1,
            'delivery_thursday_till_1' => $request->delivery_thursday_till_1,
            'delivery_thursday_from_2' => $request->delivery_thursday_from_2,
            'delivery_thursday_till_2' => $request->delivery_thursday_till_2,
            'delivery_friday_from_1' => $request->delivery_friday_from_1,
            'delivery_friday_till_1' => $request->delivery_friday_till_1,
            'delivery_friday_from_2' => $request->delivery_friday_from_2,
            'delivery_friday_till_2' => $request->delivery_friday_till_2,
            'delivery_saturday_from_1' => $request->delivery_saturday_from_1,
            'delivery_saturday_till_1' => $request->delivery_saturday_till_1,
            'delivery_saturday_from_2' => $request->delivery_saturday_from_2,
            'delivery_saturday_till_2' => $request->delivery_saturday_till_2,
            'delivery_sunday_from_1' => $request->delivery_sunday_from_1,
            'delivery_sunday_till_1' => $request->delivery_sunday_till_1,
            'delivery_sunday_from_2' => $request->delivery_sunday_from_2,
            'delivery_sunday_till_2' => $request->delivery_sunday_till_2,
            "hasSetDeliveryTimes" => true
            ]);


        return redirect("/manager/instellingen");
    }



    function addTimeToOrder_15(Request $request){
        $order = auth()->user()->merchant->orders->find($request->orderId);
        $order->update(["extraTime" => 15]);
        Mail::to($order->customer->user->email)->send(new OrderHasBeenDelayed($order));
        return response()->json([
            "message" => "ok",
            "newTime" => date("H:i", strtotime("+15 minutes", strtotime($order->requestedTime)))
        ]);       
    }

    function addTimeToOrder_30(Request $request){
        $order = auth()->user()->merchant->orders->find($request->orderId);
        $order->update(["extraTime" => 30]);
        Mail::to($order->customer->user->email)->send(new OrderHasBeenDelayed($order));
        return response()->json([
            "message" => "ok",
            "newTime" => date("H:i", strtotime("+30 minutes", strtotime($order->requestedTime)))
        ]);      }

    function addTimeToOrder_60(Request $request){
        $order = auth()->user()->merchant->orders->find($request->orderId);
        $order->update(["extraTime" => 60]);
        Mail::to($order->customer->user->email)->send(new OrderHasBeenDelayed($order));
        return response()->json([
            "message" => "ok",
            "newTime" => date("H:i", strtotime("+60 minutes", strtotime($order->requestedTime)))
        ]);      
    }



        


}
