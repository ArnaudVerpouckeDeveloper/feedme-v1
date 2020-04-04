@extends('./layouts/merchantManager')
@section('content')

<form class="createProductForm" method="POST" action="/manager/producten/addProduct">
    <div class="input-row">
        <input type="text" name="name" placeholder="Productnaam" class="name"/>
        <input type="value" name="price" placeholder="prijs" class="price"/>
        <input type="submit" value="Toevoegen"/>
    </div>
    <div class="row">
        @if(!$errors->isEmpty())
        <div class="errors">
            @foreach ($errors->all() as $error)
                <p>* {{$error}}</p>
            @endforeach
        </div>
        @endif
    </div>
</form>

<ul class="products">
    @foreach ($merchant->products as $product)
    <li data-id="{{$product->id}}">
        <div class="row upper">
            <p class="name">{{$product->name}}</p>
            <p class="price">€ {{str_replace(".", ",", $product->price)}}</p>
        </div>

        <form class="hidden">
            <div class="row inputValues">
                <input type="text" name="name" placeholder="{{$product->name}}" class="name" value="{{$product->name}}"/>
                <input type="value" name="price" placeholder="{{$product->price}}" class="price" value="{{str_replace('.', ',',$product->price)}}"/>    
            </div>
            <div class="row buttons">
                <input type="button" value="Annuleren" class="cancel-button"/>
                <input type="submit" value="Opslaan" class="update-button"/>
            </div>
        </form>

        <div class="row bottom">
            <div class="group orderable">
                <label class="info">Bestelbaar</label>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
            </div>
            <button class="edit"><span class="material-icons">edit</span></button>
            <button class="remove"><span class="material-icons">delete</span></button>
        </div>
            
    </li>
    @endforeach
</ul>

@endsection



@section("scripts")
<script src="{{asset('js/mountaineer.js')}}"></script>
<script src="{{asset('js/products.js')}}"></script>
@endsection