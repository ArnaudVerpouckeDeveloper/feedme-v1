<?php

function floatToPrice($input, $withCurrency){
    $formattedPrice = number_format($input, 2);
    $formattedPrice = str_replace(".", ",", $formattedPrice);
    if ($withCurrency){
        $formattedPrice = "€ " . $formattedPrice;
    }

    return $formattedPrice;
}

function priceToFloat($input){
    $formattedPrice = str_replace("€", "", $input);
    $formattedPrice = trim($formattedPrice);
    $formattedPrice = str_replace(",", ".", $formattedPrice);
    $formattedPrice = number_format($formattedPrice, 2);
    return $formattedPrice;
}

?>