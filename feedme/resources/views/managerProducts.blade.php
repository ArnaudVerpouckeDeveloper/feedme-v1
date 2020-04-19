@extends('./layouts/merchantManager')
@section("title", "Producten")

@section('content')


@if($merchant->productCategories->count() > 0)
<form class="createProductForm" method="POST" action="/admin/producten/addProduct" enctype="multipart/form-data">
    <label>Nieuw product aanmaken:</label>
    <div class="row input-row">
        <input type="text" name="name" placeholder="Productnaam" class="name" required/>
        <input type="value" name="price" placeholder="Prijs" class="price" required/>
        <input type="submit" value="Toevoegen"/>
    </div>
    <div class="row bottom-row">
        <div class="productCategoryAndFileUpload">
            <select name="productCategory" class="productCategory">
                @foreach ($merchant->productCategories as $productCategory)
                    <option value="{{$productCategory->id}}">{{$productCategory->name}}</option>
                @endforeach
            </select>
            <button class="productImageUploadButton">Afbeelding uploaden (aangeraden)</button>
            <input type="file" class="hidden" name="image" accept="image/*"/>
        </div>
        <textarea rows="3" placeholder="Productomschrijving (optioneel)" name="description" class="description"></textarea>
    </div>
    <div class="imagePreview hidden"/>
        <img src="#" alt="preview"/>
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
@endif

<div class="productCategories">
    <h2>Productcategorieën</h2>
    <form class="newProductCategoryForm">
        <input type="text" placeholder="Nieuwe categorienaam, bijvoorbeeld: 'vleesgerechten'"/>
        <input type="submit" value="Toevoegen"/>
    </form>
    <ul class="productCategoryList">
        @foreach ($merchant->productCategories as $productCategory)
            <li data-productCategoryId="{{$productCategory->id}}">
                <div class="upper-row">{{$productCategory->name}}</div>
                <div class="bottom-row">
                    <button class="edit"><span class="material-icons">edit</span></button>
                    <button class="remove"><span class="material-icons">delete</span></button>        
                </div>
            </li>
        @endforeach
    </ul>
    <!--
    <div class="input-row">
        <input type="text" name="name" placeholder="Productnaam" class="name" required/>
        <input type="value" name="price" placeholder="prijs" class="price" required/>
        <input type="submit" value="Toevoegen"/>
    </div>
    <div class="row">
        <textarea rows="3" placeholder="Productomschrijving (optioneel)" name="description" class="description"></textarea>
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
-->
</div>

<ul class="products">
    @foreach ($merchant->products()->orderBy("product_category_id","asc")->get() as $product)
    <li data-id="{{$product->id}}">
        <div class="row productCategoryRow">
            <p>{{$product->productCategory->name}}</p>
        </div>

        <div class="productImage row">
            @if(isset($product->imageFileName))
                <img src="{{asset('uploads/'.$product->imageFileName)}}" alt="Productafbeelding {{$product->name}}"/>
            @else
                <img src="{{asset('images/16-9_placeholder.png')}}" alt="Productafbeelding {{$product->name}}"/>
            @endif
        </div>

        <div class="row upper">
            <p class="name">{{$product->name}}</p>
            <p class="price">{{floatToPrice($product->price, true)}}</p>
        </div>

        @if(isset($product->description))
            <div class="row descriptionRow">
            <p>{{$product->description}}</p>
            </div>
        @endif

        

        <form class="hidden">
            <div class="row inputValues">
                <input type="text" name="name" placeholder="{{$product->name}}" class="name" value="{{$product->name}}"/>
                <input type="value" name="price" placeholder="{{floatToPrice($product->price, true)}}" class="price" value="{{floatToPrice($product->price, true)}}"/>    
            </div>
            <div class="row descriptionValue">
                <textarea name="description" placeholder="Productomschrijving (optioneel)">{{$product->description}}</textarea>  
            </div>
            <div class="row productCategorySelection">
                <select name="productCategory" class="productCategory">
                    @foreach ($merchant->productCategories as $productCategory)
                        <option value="{{$productCategory->id}}" {{ ($product->productCategory->id == $productCategory->id) ? 'selected' : '' }}>{{$productCategory->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row newProductImage">
                <button class="newProductImageUploadButton">nieuwe afbeelding</button>
                <input type="file" class="hidden" name="newImage" accept="image/*"/>
                <img src="#" class="hidden" alt="preview">
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
                    @if ($product->orderable)
                        <input type="checkbox" checked>
                    @else
                        <input type="checkbox">
                    @endif
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