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
            return false;
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
                    return false;
                    throw new Exception('Het order moet een minimale periode wachten.');
                }
            }
            else{
                return false;
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


    public function getPossibleRequestTimes($merchant){
        $possibleRequestTimes_takeaway = [];
        $possibleRequestTimes_delivery = [];
        $testTimes = [
            "00:00",
            "00:15",
            "00:30",
            "00:45",
            "01:00",
            "01:15",
            "01:30",
            "01:45",
            "02:00",
            "02:15",
            "02:30",
            "02:45",
            "03:00",
            "03:15",
            "03:30",
            "03:45",
            "04:00",
            "04:15",
            "04:30",
            "04:45",
            "05:00",
            "05:15",
            "05:30",
            "05:45",
            "06:00",
            "06:15",
            "06:30",
            "06:45",
            "07:00",
            "07:15",
            "07:30",
            "07:45",
            "08:00",
            "08:15",
            "08:30",
            "08:45",
            "09:00",
            "09:15",
            "09:30",
            "09:45",
            "10:00",
            "10:15",
            "10:30",
            "10:45",
            "11:00",
            "11:15",
            "11:30",
            "11:45",
            "12:00",
            "12:15",
            "12:30",
            "12:45",
            "13:00",
            "13:15",
            "13:30",
            "13:45",
            "14:00",
            "14:15",
            "14:30",
            "14:45",
            "15:00",
            "15:15",
            "15:30",
            "15:45",
            "16:00",
            "16:15",
            "16:30",
            "16:45",
            "17:00",
            "17:15",
            "17:30",
            "17:45",
            "18:00",
            "18:15",
            "18:30",
            "18:45",
            "19:00",
            "19:15",
            "19:30",
            "19:45",
            "20:00",
            "20:15",
            "20:30",
            "20:45",
            "21:00",
            "21:15",
            "21:30",
            "21:45",
            "22:00",
            "22:15",
            "22:30",
            "22:45",
            "23:00",
            "23:15",
            "23:30",
            "23:45"];

        foreach($testTimes as $testTime){
            if($this->orderPossibleInSchedule($merchant, "takeaway", $testTime)){
                array_push($possibleRequestTimes_takeaway, $testTime);
            }
        }
        
        foreach($testTimes as $testTime){
            if($this->orderPossibleInSchedule($merchant, "delivery", $testTime)){
                array_push($possibleRequestTimes_delivery, $testTime);
            }
        }

        return [
            "delivery" => $possibleRequestTimes_delivery,
            "takeaway" => $possibleRequestTimes_takeaway
        ];
            
        
    }
}