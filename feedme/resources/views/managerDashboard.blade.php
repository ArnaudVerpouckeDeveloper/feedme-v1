@extends('./layouts/merchantManager')
@section("title", "Dashboard")
@section('content')
<div class="dashboard ">
    <div class="intro">
        <h2>Welkom op uw dashboard, {{$merchant->user->firstName}}!</h2>
        <p>Via bovenstaande knoppen: dashboard, orders, producten en instellingen kan je uw horecaomgeving volledig beheren.
        SpeedMeal benadrukt nogmaals dat het gebruik van deze service volledig gratis is en wij hopen dat uw zaak hierdoor positief uit de coronacrisis kan komen.
        Indien wij belangrijke meldingen voor u hebben zullen wij dit via het dashboard en eventueel ook via e-mail communiceren met u. </p>
    </div>

    
    <div class="environmentLink">
        <h2>Uw persoonlijke link</h2>
        <p>Deze link kan u delen met al uw social media kanalen. Wanneer iemand op deze link klinkt, komt hij/zij terecht op de online webomgeving van "{{$merchant->name}}", hierop kan de klant vervolgens een bestelling op maken.</p>
        <p class="link"><a href="https://www.speedmeal.be/{{$merchant->apiName}}">https://www.speedmeal.be/{{$merchant->apiName}}</a></p>
    </div>

        
    <div class="basic-metrics">
        <h2>Prestatieparameters</h2>
        <p>Tracht deze parameters ten allen tijde groen te houden, indien een parameter oranje kleurt is dit een waarschuwing, een rode kleur dient zo snel mogelijk opgelost te worden.</p>
        <ul>
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
                <p class="top"><span class="material-icons">fastfood</span>Producten</p>
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
                <p class="top"><span class="material-icons">receipt</span>Open orders</p>
                <p class="value">{{$amountOfOpenOrders}}</p>
            </li>
    
    
    
            @php 
                $amountOfVisitorsClass = "";
                if($amountOfVisitors < 10){
                    $amountOfVisitorsClass = "danger";
                }
                elseif($amountOfVisitors < 50){
                    $amountOfVisitorsClass = "warning";
                }
            @endphp
            <li class="{{$amountOfVisitorsClass}}">
                <p class="top"><span class="material-icons">visibility</span>Bezoekers</p>
                <p class="value">{{$amountOfVisitors}}</p>
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
    
    </div>
  
    <div class="checklist">
        <h2>Checklist</h2>
        <p>Onderstaande zaken dienen in orde gebracht te worden:</p>
        <ul>
            @foreach ($checklist as $todo)
            <li>
                <p class="instruction">{{$todo["instruction"]}}</p>
                @switch($todo["location"])
                    @case("settings")
                        <a class="location" href="/admin/instellingen">Instellingen</a>
                        @break
                    @case("orders")
                        <a class="location" href="/admin/orders">Orders</a>
                        @break
                    @case("products")
                        <a class="location" href="/admin/producten">Producten</a>
                        @break
                    @default
                @endswitch
            </li>
            @endforeach
        </ul>
    </div>

</div>    
@endsection