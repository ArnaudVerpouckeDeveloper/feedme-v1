<?php
namespace App\Traits;
use App\Merchant;
use Exception;
use DateTime;


trait SharedMerchantTrait
{
    public function orderPossibleInSchedule($merchant, $orderDeliveryMethod, $requestedTime){
        $method_today_from_1 = null;
        $method_today_till_1 = null;
        $method_today_from_2 = null;
        $method_today_till_2 = null;

        switch (date('w')) {
            case 1:
                //monday
                if($orderDeliveryMethod == "takeaway"){
                    $method_today_from_1 = $merchant->takeaway_monday_from_1;
                    $method_today_till_1 = $merchant->takeaway_monday_till_1;
                    $method_today_from_2 = $merchant->takeaway_monday_from_2;
                    $method_today_till_2 = $merchant->takeaway_monday_till_2;
                }
                elseif($orderDeliveryMethod == "delivery"){
                    $method_today_from_1 = $merchant->delivery_monday_from_1;
                    $method_today_till_1 = $merchant->delivery_monday_till_1;
                    $method_today_from_2 = $merchant->delivery_monday_from_2;
                    $method_today_till_2 = $merchant->delivery_monday_till_2;
                }          
                break;
                break;
            case 2:
                //tuesday
                if($orderDeliveryMethod == "takeaway"){
                    $method_today_from_1 = $merchant->takeaway_tuesday_from_1;
                    $method_today_till_1 = $merchant->takeaway_tuesday_till_1;
                    $method_today_from_2 = $merchant->takeaway_tuesday_from_2;
                    $method_today_till_2 = $merchant->takeaway_tuesday_till_2;
                }
                elseif($orderDeliveryMethod == "delivery"){
                    $method_today_from_1 = $merchant->delivery_tuesday_from_1;
                    $method_today_till_1 = $merchant->delivery_tuesday_till_1;
                    $method_today_from_2 = $merchant->delivery_tuesday_from_2;
                    $method_today_till_2 = $merchant->delivery_tuesday_till_2;
                }          
                break;
            case 3:
                //wednesday
                if($orderDeliveryMethod == "takeaway"){
                    $method_today_from_1 = $merchant->takeaway_wednesday_from_1;
                    $method_today_till_1 = $merchant->takeaway_wednesday_till_1;
                    $method_today_from_2 = $merchant->takeaway_wednesday_from_2;
                    $method_today_till_2 = $merchant->takeaway_wednesday_till_2;
                }
                elseif($orderDeliveryMethod == "delivery"){
                    $method_today_from_1 = $merchant->delivery_wednesday_from_1;
                    $method_today_till_1 = $merchant->delivery_wednesday_till_1;
                    $method_today_from_2 = $merchant->delivery_wednesday_from_2;
                    $method_today_till_2 = $merchant->delivery_wednesday_till_2;
                }         
                break;
            case 4:
                //thursday
                if($orderDeliveryMethod == "takeaway"){
                    $method_today_from_1 = $merchant->takeaway_thursday_from_1;
                    $method_today_till_1 = $merchant->takeaway_thursday_till_1;
                    $method_today_from_2 = $merchant->takeaway_thursday_from_2;
                    $method_today_till_2 = $merchant->takeaway_thursday_till_2;
                }
                elseif($orderDeliveryMethod == "delivery"){
                    $method_today_from_1 = $merchant->delivery_thursday_from_1;
                    $method_today_till_1 = $merchant->delivery_thursday_till_1;
                    $method_today_from_2 = $merchant->delivery_thursday_from_2;
                    $method_today_till_2 = $merchant->delivery_thursday_till_2;
                }         
                break;
            case 5:
                //friday
                if($orderDeliveryMethod == "takeaway"){
                    $method_today_from_1 = $merchant->takeaway_friday_from_1;
                    $method_today_till_1 = $merchant->takeaway_friday_till_1;
                    $method_today_from_2 = $merchant->takeaway_friday_from_2;
                    $method_today_till_2 = $merchant->takeaway_friday_till_2;
                }
                elseif($orderDeliveryMethod == "delivery"){
                    $method_today_from_1 = $merchant->delivery_friday_from_1;
                    $method_today_till_1 = $merchant->delivery_friday_till_1;
                    $method_today_from_2 = $merchant->delivery_friday_from_2;
                    $method_today_till_2 = $merchant->delivery_friday_till_2;
                }         
                break;
            case 6:
                //saturday
                if($orderDeliveryMethod == "takeaway"){
                    $method_today_from_1 = $merchant->takeaway_saturday_from_1;
                    $method_today_till_1 = $merchant->takeaway_saturday_till_1;
                    $method_today_from_2 = $merchant->takeaway_saturday_from_2;
                    $method_today_till_2 = $merchant->takeaway_saturday_till_2;
                }
                elseif($orderDeliveryMethod == "delivery"){
                    $method_today_from_1 = $merchant->delivery_saturday_from_1;
                    $method_today_till_1 = $merchant->delivery_saturday_till_1;
                    $method_today_from_2 = $merchant->delivery_saturday_from_2;
                    $method_today_till_2 = $merchant->delivery_saturday_till_2;
                }         
                break;
            case 0:
                //sunday
                if($orderDeliveryMethod == "takeaway"){
                    $method_today_from_1 = $merchant->takeaway_sunday_from_1;
                    $method_today_till_1 = $merchant->takeaway_sunday_till_1;
                    $method_today_from_2 = $merchant->takeaway_sunday_from_2;
                    $method_today_till_2 = $merchant->takeaway_sunday_till_2;
                }
                elseif($orderDeliveryMethod == "delivery"){
                    $method_today_from_1 = $merchant->delivery_sunday_from_1;
                    $method_today_till_1 = $merchant->delivery_sunday_till_1;
                    $method_today_from_2 = $merchant->delivery_sunday_from_2;
                    $method_today_till_2 = $merchant->delivery_sunday_till_2;
                }         
                break;
            default:
                break;
        }

        $currentTime = DateTime::createFromFormat('H:i', date("H:i"));
        $requestedTime = DateTime::createFromFormat('H:i', $requestedTime);
        $method_today_from_1 = DateTime::createFromFormat('H:i', $method_today_from_1);
        $method_today_till_1 = DateTime::createFromFormat('H:i', $method_today_till_1);
        $method_today_from_2 = DateTime::createFromFormat('H:i', $method_today_from_2);
        $method_today_till_2 = DateTime::createFromFormat('H:i', $method_today_till_2);

        if ($currentTime > $requestedTime){ //example: (16:00 < 18:00) returns true
            throw new Exception('Een order kan niet in het verleden geplaatst worden.');
        }else{
            if (($requestedTime > $method_today_from_1 && $requestedTime < $method_today_till_1)||($requestedTime > $method_today_from_2 && $requestedTime < $method_today_till_2))
            {
                $minimumWaitTime = null;
                if ($orderDeliveryMethod == "takeaway"){
                    $minimumWaitTime = $merchant->minimumWaitTime_takeaway;
                }
                elseif( $orderDeliveryMethod == "delivery"){
                    $minimumWaitTime = $merchant->minimumWaitTime_delivery;
                }
                $currentTimeRoundedToNearestQuarter = $this->roundToNearestMinuteInterval($currentTime, 15);
                $fastestTimeAnOrderMayBePlaced = $this->roundToNearestMinuteInterval(DateTime::createFromFormat("H:i",$currentTimeRoundedToNearestQuarter), $this->time_to_decimal($minimumWaitTime));
                $fastestTimeAnOrderMayBePlaced = DateTime::createFromFormat('H:i',date("H:i", strtotime('30 minutes', strtotime($currentTimeRoundedToNearestQuarter))));

                if($requestedTime >= $fastestTimeAnOrderMayBePlaced){ 
                    return true;
                }
                else{
                    throw new Exception('Het order moet een minimale periode wachten.');
                }
            }
            else{
                throw new Exception('Een order plaatsen op het gekozen tijdstip is niet mogelijk.');
            }
        }        
    }



    private function roundToNearestMinuteInterval(\DateTime $dateTime, $minuteInterval)
    {       
        $minuteInterval = $minuteInterval * 60;
        return date("H:i",ceil(strtotime($dateTime->format('H:i'))/$minuteInterval)*$minuteInterval);
    }

    private function time_to_decimal($time) {
        $timeArr = explode(':', $time);
        $decTime = ($timeArr[0]*60) + ($timeArr[1]);
        return $decTime;
    }
}