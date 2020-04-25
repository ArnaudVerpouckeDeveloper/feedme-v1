<!DOCTYPE html>
<html>
<head>
  <title>Voorlopige bevestiging van uw order</title>
</head>
<body style="font-family:Poppins,sans-serif;padding:2rem;">
<h1 style="font-size: 2rem;color:#4CAF50;margin-top:0;">Uw order werd voorlopig bevestigd:</h1>
<p style="margin-bottom: 1rem; color: red; font-weight: bold;">{{$order->merchant->name}} dient uw bestelling eerst nog te aanvaarden. Zodra uw bestelling aanvaard werd, zult u hiervan een bevestiging per e-mail ontvangen. Let op: het door u gekozen tijdstip ({{$order->requestedTime->format("H:i")}}) kan tot 60 minuten uitgesteld worden. Indien {{$order->merchant->name}} uw order uitstelt, zult u dit ook in de e-mail kunnen raadplegen.</p>

<ul style="margin-bottom: 1rem; padding: 0;">
  @php
       $productIdsInOrder = [];
       foreach ($order->products as $product){
           if (!in_array($product->id, $productIdsInOrder)){
               array_push($productIdsInOrder, $product->id);
           }
       }
  @endphp
  @foreach ($productIdsInOrder as $productId)
       @php
          $processedProduct = null;
          $amountOfThisProduct = 0;
          foreach ($order->products as $product){
              if ($product->id == $productId){
                  $processedProduct = $product;
                  $amountOfThisProduct++;
              }
          }
       @endphp
      <li style="display: flex;"><p class="amount" style="width: 3rem; margin: 0;">{{$amountOfThisProduct}} x</p><p style="margin: 0;"> {{$processedProduct->name}}</p></li>
  @endforeach
</ul>
<p style="margin-bottom: 3rem; font-weight: bold;">Totaalprijs: {{floatToPrice($order->totalPrice, true)}}</p>


<ul style="margin-bottom: 3rem; padding: 0;">
  @php $customer = $order->customer->user; @endphp
  <li style="display: flex;"><p style="width: 12rem; margin:0;">Naam:</p><p style="margin:0;">{{$customer->firstName}} {{$customer->lastName}} </p></li>
  <li style="display: flex; margin-bottom:1rem;"><p style="width: 12rem; margin:0;">GSM-nummer:</p><p style="margin:0;">{{$customer->mobilePhone}}</p></li>
  
  @if($order->deliveryMethod == "takeaway")
    <li style="display: flex; margin-bottom:1rem;"><p style="width: 12rem; margin:0;">Tijdstip:</p><p style="margin:0;">Afhalen om {{$order->requestedTime->format('H:i')}}</p></li>
    <li style="display: flex;"><p style="width: 12rem; margin:0;">Afhaaladres:</p><p style="margin:0;">{{$order->merchant->address_street}} {{$order->merchant->address_number}}</p></li>
    <li style="display: flex;"><p style="width: 12rem; margin:0;"></p><p style="margin:0;">{{$order->merchant->address_zip}} {{$order->merchant->address_city}}</p></li>  
  @elseif($order->deliveryMethod == "delivery")
    <li style="display: flex; margin-bottom:1rem;"><p style="width: 12rem; margin:0;">Tijdstip:</p><p style="margin:0;">Leveren om {{$order->requestedTime->format('H:i')}}</p></li>
    <li style="display: flex;"><p style="width: 12rem; margin:0;">Adres:</p><p style="margin:0;">{{$order->addressStreet}} {{$order->addressNumber}}</p></li>
    <li style="display: flex;"><p style="width: 12rem; margin:0;"></p><p style="margin:0;">{{$order->addressZipCode}} {{$order->addressCity}}</p></li>  
  @endif
  @if(isset($order->details))
    <li style="display: flex; margin-bottom:1rem; margin-top: 1rem;"><p style="width: 12rem; margin:0;">Opmerkingen:</p><p style="margin:0;">{{$order->details}}</p></li>
  @endif
</ul>

<p style="margin-bottom: 0;">Indien er zich een probleem zou voordoen dient u contact op te nemen met {{$order->merchant->name}}, dit kan via {{$order->merchant->merchantPhone}}.</p>
<p style="margin-bottom: 2rem;margin-top:0;">Gelieve de veiligheidsmaatregelen i.v.m. corona te respecteren! #staysafe</p>
<p style="margin-bottom: 0;">Met smakelijke groeten</p>
<p style="margin-bottom:1rem;margin-top: 0;">Team SpeedMeal</p>
</body>
</html>