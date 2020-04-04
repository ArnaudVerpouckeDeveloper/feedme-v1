@extends('./layouts/merchantManager')

@section('content')
    <ul class="orders">
        @foreach ($merchant->orders as $order)
        <li class="order">
            <ul class="orderSections">
                <li class="orderOverview">
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
                    @if (isset($order->details))
                    <div class="remarks">
                        <p class="title">Opmerkingen:</p>
                        <p>{{$order->details}}</p>
                    </div>
                    @endif
                </li>
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
                <li class="action confirmOrder"><span class="material-icons">check</span><p>Bevestig</p></li>
                <li class="action denyOrder"><span class="material-icons">close</span><p>Weiger</p></li>
                <li class="totalPrice">Totale prijs: €21,60</li>
            </ul>
        </li>
        @endforeach
        
    </ul>
    
@endsection