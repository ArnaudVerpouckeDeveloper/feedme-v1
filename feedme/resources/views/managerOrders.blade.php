@extends('./layouts/merchantManager')

@section('content')
    <ul class="orders">
        @foreach ($merchant->orders as $order)
        @if($order->confirmed)
    <li class="order confirmed" data-orderId="{{$order->id}}">
        
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

                <p class="totalPrice">Totale prijs: € {{str_replace(".",",",$order->totalPrice)}}</p>

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
            <ul class="orderSections">
                <li class="deliveryMethod">
                    @if($order->deliveryMethod == "delivery")
                        <p class="type">leveren</p>
                        <p class="time">16:00</p>
                    @endif
                    @if($order->deliveryMethod == "takeaway")
                        <p class="type">afhalen</p>
                        <p class="time">16:00</p>
                    @endif
                </li>
                @if ($order->confirmed || $order->denied)

                @else
                    <li class="action confirmOrder"><span class="material-icons">check</span><p>Bevestig</p></li>
                    <li class="action denyOrder"><span class="material-icons">close</span><p>Weiger</p></li>
                @endif
                </ul>
        </li>
        @endforeach
        
    </ul>
    
@endsection

@section("scripts")
<script src="{{asset('js/mountaineer.js')}}"></script>
<script src="{{asset('js/orders.js')}}"></script>
@endsection