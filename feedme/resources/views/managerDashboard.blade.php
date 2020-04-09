@extends('./layouts/merchantManager')
@section('content')
<div class="dashboard">
    <ul class="basic-metrics">
        @php 
            $amountOfProductsClass = ""; 
            if($amountOfProducts == 0){
                $amountOfProductsClass = "danger";
            }
            elseif($amountOfProducts < 5){
                $amountOfProductsClass = "warning";
            }
        @endphp
        <li class="{{$amountOfProductsClass}}">
            <p class="top"><span class="material-icons">fastfood</span>Aantal producten</p>
            <p class="value">{{$amountOfProducts}}</p>
        </li>



        @php 
            $amountOfOpenOrdersClass = "";
            if($amountOfOpenOrders > 3){
                $amountOfOpenOrdersClass = "danger";
            }
            elseif($amountOfOpenOrders > 0){
                $amountOfOpenOrdersClass = "warning";
            }
        @endphp
        <li class="{{$amountOfOpenOrdersClass}}">
            <p class="top"><span class="material-icons">receipt</span>Aantal open orders</p>
            <p class="value">{{$amountOfOpenOrders}}</p>
        </li>




        <li>
            <p class="top"><span class="material-icons">receipt</span>Aantal gesloten orders</p>
            <p class="value">{{$amountOfClosedOrders}}</p>
        </li>



        @php 
            $amountOfToDosClass = "";
            if($amountOfToDos > 3){
                $amountOfToDosClass = "danger";
            }
            elseif($amountOfToDos > 0){
                $amountOfToDosClass = "warning";
            }
        @endphp
        <li class="{{$amountOfToDosClass}}">
            <p class="top"><span class="material-icons">list</span>Checklist</p>
            <p class="value">{{$amountOfToDos}}</p>
        </li>
    </ul>

    <div class="environmentLink">
        <h2>Link</h2>
        <p></p>
    </div>
</div>    
@endsection