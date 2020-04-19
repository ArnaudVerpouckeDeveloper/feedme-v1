@extends('./layouts/merchantManager')
@section("title", "Orders")

@section('content')
    <ul class="orders">
        @foreach ($merchant->orders()->where("completed",false)->where("denied", false)->orderBy("accepted", "asc")->orderBy("requestedTime", "asc")->get() as $order)
        @php $order->requestedTime = date("H:i", strtotime($order->requestedTime)); @endphp
        @if($order->accepted)
            <li class="order accepted" data-orderId="{{$order->id}}">
        @elseif($order->denied)
            <li class="order denied" data-orderId="{{$order->id}}">
        @else
            <li class="order" data-orderId="{{$order->id}}">
        @endif
            <div class="orderOverview">
                <ul>
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
                        <li><p class="amount">{{$amountOfThisProduct}} x</p><p> {{$processedProduct->name}}</p></li>
                    @endforeach
                </ul>

                <p class="totalPrice">Totale prijs: {{floatToPrice($order->totalPrice, true)}}</p>

                @if (isset($order->details))
                <div class="remarks">
                    <p class="title">Opmerkingen:</p>
                    <p>{{$order->details}}</p>
                </div>
                @endif

                <?php
                    $customer = $order->customer->user;
                ?>
                <div class="contactDetails">
                    <p class="title">Informatie:</p>
                    <p><span>Naam:</span> {{$customer->firstName}} {{$customer->lastName}}</p>
                    <p><span>Telefoonnummer:</span> {{$customer->mobilePhone}}</p>
                    <p><span>Order aangemaakt om:</span> {{$order->created_at}}</p>
                </div>

                @if ($order->deliveryMethod == "delivery")
                <div class="deliveryDetails">
                    <p class="title">Leveradres:</p>
                    <p>{{$order->addressStreet}} {{$order->addressNumber}}</p>
                    <p>{{$order->addressZipCode}} {{$order->addressCity}}</p>
                </div>
                @endif

            </div>
            <div class="orderSections">
                <ul class="row">
                    <li class="deliveryMethod {{$order->extratime != null?'delayed':''}}">
                        @if($order->deliveryMethod == "delivery")
                            <p class="type">leveren</p>
                            <p class="time {{$order->extratime != null?'lineThrough':''}}">{{$order->requestedTime}}</p>
                        @endif
                        @if($order->deliveryMethod == "takeaway")
                            <p class="type">afhalen</p>
                            <p class="time {{$order->extratime != null?'lineThrough':''}}">{{$order->requestedTime}}</p>
                        @endif

                        @if($order->extratime != "" || $order->extratime != null)
                            <p class="timeDelay">{{date("H:i", strtotime("+".$order->extratime." minutes", strtotime($order->requestedTime)))}}</p>
                        @endif                    
                    </li>
                    @if ($order->accepted)
                        <li class="action completeOrder"><span class="material-icons">check</span><p>Voltooi</p></li>
                    @else
                        <li class="action acceptOrder"><span class="material-icons">check</span><p>Accepteer</p></li>
                        <li class="action denyOrder"><span class="material-icons">close</span><p>Weiger</p></li>
                    @endif
            </ul>

            @if (!$order->accepted)
                <ul class="row delayActions">
                    <li class="action addExtraTime addExtraTime_15 {{$order->extratime === '15'?'delayed':''}}"><span class="material-icons">schedule</span><p>+15 min.</p></li>
                    <li class="action addExtraTime addExtraTime_30 {{$order->extratime === '30'?'delayed':''}}"><span class="material-icons">schedule</span><p>+30 min.</p></li>
                    <li class="action addExtraTime addExtraTime_60 {{$order->extratime === '60'?'delayed':''}}"><span class="material-icons">schedule</span><p>+60 min.</p></li>
                </ul>
            @endif
            </div>
        </li>
        @endforeach
    </ul>

    <a class="bottomLink" href="/admin/ordergeschiedenis">Bekijk uw ordergeschiedenis.</a>
    
@endsection

@section("scripts")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{asset('js/mountaineer.js')}}"></script>
<script>
    let notificationSound = new Audio('{{asset("audio/notificationSound.mp3")}}');
    let newOrderSound = new Audio('{{asset("audio/notificationSound_important.mp3")}}');

</script>
<script src="{{asset('js/orders.js')}}"></script>

@endsection