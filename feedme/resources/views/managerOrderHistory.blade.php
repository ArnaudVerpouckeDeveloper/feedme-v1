@extends('./layouts/merchantManager')
@section("title", "Ordergeschiedenis")
@section('content')
    <ul class="orders">
        @foreach ($merchant->orders()->where("completed",true)->orWhere("denied",true)->orderBy("requestedTime", "desc")->get() as $order)
        @php $order->requestedTime = date("H:i", strtotime($order->requestedTime)); @endphp
        @if($order->accepted)
            <li class="order accepted" data-orderId="{{$order->id}}">
        @elseif($order->denied)
            <li class="order denied" data-orderId="{{$order->id}}">
        @else
            <li class="order" data-orderId="{{$order->id}}">
        @endif
            <div class="orderOverview">
                @if($order->accepted)
                <h2 class="status">Afgerond</h2>
                @elseif($order->denied)
                <h2 class="status">Geweigerd</h2>
                @endif
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
        </li>
        @endforeach
    </ul>

    <a class="bottomLink" href="/admin/orders">Bekijk uw orders.</a>
    
@endsection

@section("scripts")

@endsection