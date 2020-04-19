@extends('./layouts/merchantManager')
@section("title", "Instellingen")
@section('content')
<div class="settings screen-container">
    <form method="POST" action="/admin/settings/updateMerchantDetails" enctype="multipart/form-data" class="merchantDetailsForm" id="link-gegevens-horeca-zaak">
        {{method_field('PUT')}}
        @csrf

        <label>Gegevens horecazaak:</label>
        <div class="row">
            <label>Naam</label>
            <input type="text" placeholder="{{$merchant->name}}" value="{{$merchant->name}}" name="name"/>
            @error("name")
                <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="row">
            <label>Telefoonnummer</label>
            <input type="text" placeholder="{{$merchant->merchantPhone}}" value="{{$merchant->merchantPhone}}" name="merchantPhone"/>
            @error("merchantPhone")
                <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="row">
            <label>Straat</label>
            <input type="text" placeholder="{{$merchant->address_street}}" value="{{$merchant->address_street}}" name="address_street"/>
            <label>Nummer</label>
            <input type="text" placeholder="{{$merchant->address_number}}" value="{{$merchant->address_number}}" name="address_number"/>
            @error("address_street")
                <p class="error">{{$message}}</p>
            @enderror
            @error("address_number")
                <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="row">
            <label>Postcode</label>
            <input type="text" placeholder="{{$merchant->address_zip}}" value="{{$merchant->address_zip}}" name="address_zip"/>
            <label>Stad</label>
            <input type="text" placeholder="{{$merchant->address_city}}" value="{{$merchant->address_city}}" name="address_city"/>
            @error("address_zip")
                <p class="error">{{$message}}</p>
            @enderror
            @error("address_city")
                <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="row">
            <label>BTW nummer</label>
            <input type="text" placeholder="{{$merchant->tax_number}}" value="{{$merchant->tax_number}}" name="tax_number"/>
            @error("tax_number")
                <p class="error">{{$message}}</p>
            @enderror
        </div>
        <input type="submit" value="opslaan"/>

    </form>

    <form method="POST" action="/admin/settings/updateBanner" enctype="multipart/form-data" class="bannerForm" id="link-banner">
        {{method_field('PUT')}}
        @csrf

        <label>Banner (max 5MB)</label>
        <input type="file" accept="image/*" name="banner" />
        @if(isset($merchant->bannerFileName))
            <img src="{{asset('uploads/'.$merchant->bannerFileName)}}" alt="banner"/>
        @else
            <img src="{{asset('images/placeholder_banner.png')}}" alt="banner"/>
        @endif
        <input type="submit" value="uploaden"/>
        @error("banner")
            <p class="error">De banner kon niet geüpload worden, controleer of het bestand kleiner dan 5MB is.</p>
        @enderror
    </form>
    
    <form method="POST" action="/admin/settings/updateLogo" enctype="multipart/form-data" class="logoForm" id="link-logo">
        {{method_field('PUT')}}
        @csrf

        <label>Logo (max 5MB)</label>
        <input type="file" accept="image/*" name="logo"/>
        @if(isset($merchant->logoFileName))
            <img src="{{asset('uploads/'.$merchant->logoFileName)}}" alt="logo" class="square"/>
        @else
            <img src="{{asset('images/placeholder_logo.png')}}" alt="logo" class="square"/>
        @endif
        <input type="submit" value="uploaden"/>
        @error("logo")
            <p class="error">Het logo kon niet geüpload worden, controleer of het bestand kleiner dan 5MB is.</p>
        @enderror
    </form>
    
    <form method="POST" action="/admin/settings/updateMessage" id="link-bericht">
        {{method_field('PUT')}}
        @csrf

        <label>Bericht (bovenaan pagina)</label>
        <textarea rows="4" name="message">{{$merchant->message}}</textarea>
        @error("message")
            <p>{{message}}</p>
        @enderror
        <input type="submit" value="Opslaan"/>
    </form>

    <form method="POST" action="/admin/settings/updateMinimumOrderValue" class="simpleInputForm" id="link-minimum-bedrag-bestelling">
        {{method_field('PUT')}}
        @csrf
        <label>Minimaal bedrag per bestelling:</label>
        <div class="row">
        <input type="text" name="minimumOrderValue" required value="{{floatToPrice($merchant->minimumOrderValue, true)}}" placeholder="{{floatToPrice($merchant->minimumOrderValue, true)}}"/>
        </div>
        @error("minimumOrderValue")
            <p>Het ingegeven formaat van de prijs bleek niet geldig te zijn.</p>
        @enderror
        <input type="submit" value="opslaan"/>
    </form>






    <form method="POST" action="/admin/settings/updateTakeawayHours" class="schedule" id="link-schema-afhaling">
        {{method_field('PUT')}}
        @csrf

        <label>Afhalen:</label>
        <div class="row">
            <label><b>Maandag</b></label>
            <label>van:</label>
            <select name="takeaway_monday_from_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label>
            <select name="takeaway_monday_till_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label><b>en</b></label>
            <label>van:</label><select name="takeaway_monday_from_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label><select name="takeaway_monday_till_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
        </div>

        <div class="row">
            <label><b>Dinsdag</b></label>
            <label>van:</label>
            <select name="takeaway_tuesday_from_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label>
            <select name="takeaway_tuesday_till_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label><b>en</b></label>
            <label>van:</label><select name="takeaway_tuesday_from_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label><select name="takeaway_tuesday_till_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
        </div>

        <div class="row">
            <label><b>Woensdag</b></label>
            <label>van:</label>
            <select name="takeaway_wednesday_from_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label>
            <select name="takeaway_wednesday_till_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label><b>en</b></label>
            <label>van:</label><select name="takeaway_wednesday_from_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label><select name="takeaway_wednesday_till_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
        </div>

        <div class="row">
            <label><b>Donderdag</b></label>
            <label>van:</label>
            <select name="takeaway_thursday_from_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label>
            <select name="takeaway_thursday_till_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label><b>en</b></label>
            <label>van:</label><select name="takeaway_thursday_from_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label><select name="takeaway_thursday_till_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
        </div>

        <div class="row">
            <label><b>Vrijdag</b></label>
            <label>van:</label>
            <select name="takeaway_friday_from_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label>
            <select name="takeaway_friday_till_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label><b>en</b></label>
            <label>van:</label><select name="takeaway_friday_from_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label><select name="takeaway_friday_till_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
        </div>

        <div class="row">
            <label><b>Zaterdag</b></label>
            <label>van:</label>
            <select name="takeaway_saturday_from_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label>
            <select name="takeaway_saturday_till_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label><b>en</b></label>
            <label>van:</label><select name="takeaway_saturday_from_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label><select name="takeaway_saturday_till_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
        </div>

        <div class="row">
            <label><b>Zondag</b></label>
            <label>van:</label>
            <select name="takeaway_sunday_from_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label>
            <select name="takeaway_sunday_till_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label><b>en</b></label>
            <label>van:</label><select name="takeaway_sunday_from_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label><select name="takeaway_sunday_till_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
        </div>
        
     <input type="submit" value="opslaan"/>
    </form>


    <form method="POST" action="/admin/settings/updateMinimumWaitTimeForTakeaway" class="schedule" id="link-minimum-wachttijd-afhaling">
        {{method_field('PUT')}}
        @csrf
        <label>Minimale wachttijd voor afhalingen:</label>
        <div class="row">
            <select name="minimumWaitTime_takeaway">
                <option value='00:15'>00:15</option>
                <option value='00:30'>00:30</option>
                <option value='00:45'>00:45</option>
                <option value='01:00'>01:00</option>
                <option value='01:15'>01:15</option>
                <option value='01:30'>01:30</option>
                <option value='01:45'>01:45</option>
                <option value='02:00'>02:00</option>
                <option value='02:15'>02:15</option>
                <option value='02:30'>02:30</option>
                <option value='02:45'>02:45</option>
                <option value='03:00'>03:00</option>
            </select>
        </div>
        <input type="submit" value="opslaan"/>
    </form>






    <form method="POST" action="/admin/settings/updateDeliveryHours" class="schedule" id="link-schema-levering">
        {{method_field('PUT')}}
        @csrf

        <label>Leveren:</label>
        <div class="row">
            <label><b>Maandag</b></label>
            <label>van:</label>
            <select name="delivery_monday_from_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label>
            <select name="delivery_monday_till_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label><b>en</b></label>
            <label>van:</label><select name="delivery_monday_from_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label><select name="delivery_monday_till_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
        </div>

        <div class="row">
            <label><b>Dinsdag</b></label>
            <label>van:</label>
            <select name="delivery_tuesday_from_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label>
            <select name="delivery_tuesday_till_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label><b>en</b></label>
            <label>van:</label><select name="delivery_tuesday_from_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label><select name="delivery_tuesday_till_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
        </div>

        <div class="row">
            <label><b>Woensdag</b></label>
            <label>van:</label>
            <select name="delivery_wednesday_from_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label>
            <select name="delivery_wednesday_till_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label><b>en</b></label>
            <label>van:</label><select name="delivery_wednesday_from_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label><select name="delivery_wednesday_till_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
        </div>

        <div class="row">
            <label><b>Donderdag</b></label>
            <label>van:</label>
            <select name="delivery_thursday_from_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label>
            <select name="delivery_thursday_till_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label><b>en</b></label>
            <label>van:</label><select name="delivery_thursday_from_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label><select name="delivery_thursday_till_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
        </div>

        <div class="row">
            <label><b>Vrijdag</b></label>
            <label>van:</label>
            <select name="delivery_friday_from_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label>
            <select name="delivery_friday_till_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label><b>en</b></label>
            <label>van:</label><select name="delivery_friday_from_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label><select name="delivery_friday_till_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
        </div>

        <div class="row">
            <label><b>Zaterdag</b></label>
            <label>van:</label>
            <select name="delivery_saturday_from_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label>
            <select name="delivery_saturday_till_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label><b>en</b></label>
            <label>van:</label><select name="delivery_saturday_from_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label><select name="delivery_saturday_till_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
        </div>

        <div class="row">
            <label><b>Zondag</b></label>
            <label>van:</label>
            <select name="delivery_sunday_from_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label>
            <select name="delivery_sunday_till_1">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label><b>en</b></label>
            <label>van:</label><select name="delivery_sunday_from_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
            <label>tot:</label><select name="delivery_sunday_till_2">
                <option value='not-possible'>Niet mogelijk</option>
                <option value='00:00'>00:00</option>
                <option value='00:30'>00:30</option>
                <option value='01:00'>01:00</option>
                <option value='01:30'>01:30</option>
                <option value='02:00'>02:00</option>
                <option value='02:30'>02:30</option>
                <option value='03:00'>03:00</option>
                <option value='03:30'>03:30</option>
                <option value='04:00'>04:00</option>
                <option value='04:30'>04:30</option>
                <option value='05:00'>05:00</option>
                <option value='05:30'>05:30</option>
                <option value='06:00'>06:00</option>
                <option value='06:30'>06:30</option>
                <option value='07:00'>07:00</option>
                <option value='07:30'>07:30</option>
                <option value='08:00'>08:00</option>
                <option value='08:30'>08:30</option>
                <option value='09:00'>09:00</option>
                <option value='09:30'>09:30</option>
                <option value='10:00'>10:00</option>
                <option value='10:30'>10:30</option>
                <option value='11:00'>11:00</option>
                <option value='11:30'>11:30</option>
                <option value='12:00'>12:00</option>
                <option value='12:30'>12:30</option>
                <option value='13:00'>13:00</option>
                <option value='13:30'>13:30</option>
                <option value='14:00'>14:00</option>
                <option value='14:30'>14:30</option>
                <option value='15:00'>15:00</option>
                <option value='15:30'>15:30</option>
                <option value='16:00'>16:00</option>
                <option value='16:30'>16:30</option>
                <option value='17:00'>17:00</option>
                <option value='17:30'>17:30</option>
                <option value='18:00'>18:00</option>
                <option value='18:30'>18:30</option>
                <option value='19:00'>19:00</option>
                <option value='19:30'>19:30</option>
                <option value='20:00'>20:00</option>
                <option value='20:30'>20:30</option>
                <option value='21:00'>21:00</option>
                <option value='21:30'>21:30</option>
                <option value='22:00'>22:00</option>
                <option value='22:30'>22:30</option>
                <option value='23:00'>23:00</option>
                <option value='23:30'>23:30</option></select>
        </div>
        
     <input type="submit" value="opslaan"/>
    </form>

    <form method="POST" action="/admin/settings/updateMinimumWaitTimeForDelivery" class="schedule" id="link-minimum-wachttijd-levering">
        {{method_field('PUT')}}
        @csrf
        <label>Minimale wachttijd voor leveringen:</label>
        <div class="row">
            <select name="minimumWaitTime_delivery">
                <option value='00:15'>00:15</option>
                <option value='00:30'>00:30</option>
                <option value='00:45'>00:45</option>
                <option value='01:00'>01:00</option>
                <option value='01:15'>01:15</option>
                <option value='01:30'>01:30</option>
                <option value='01:45'>01:45</option>
                <option value='02:00'>02:00</option>
                <option value='02:15'>02:15</option>
                <option value='02:30'>02:30</option>
                <option value='02:45'>02:45</option>
                <option value='03:00'>03:00</option>
            </select>
        </div>
        <input type="submit" value="opslaan"/>
    </form>

    <form method="POST" action="/admin/settings/updateDeliveryCost" class="simpleInputForm" id="link-leveringskosten">
        {{method_field('PUT')}}
        @csrf
        <label>Kosten per levering:</label>
        <div class="row">
        <input type="text" name="deliveryCost" required value="{{floatToPrice($merchant->deliveryCost, true)}}" placeholder="{{floatToPrice($merchant->deliveryCost, true)}}" />
        </div>
        @error("deliveryCost")
            <p>Het ingegeven formaat van de prijs bleek niet geldig te zijn.</p>
        @enderror
        <input type="submit" value="opslaan"/>
    </form>





   

    






</div>
@endsection



@section("scripts")
<script type="text/javascript">
    let takeAwaySchedule = [
        {name: "takeaway_monday_from_1", value: "{{$merchant->takeaway_monday_from_1}}"},
        {name: "takeaway_monday_till_1", value: "{{$merchant->takeaway_monday_till_1}}"},
        {name: "takeaway_monday_from_2", value: "{{$merchant->takeaway_monday_from_2}}"},
        {name: "takeaway_monday_till_2", value: "{{$merchant->takeaway_monday_till_2}}"},
        {name: "takeaway_tuesday_from_1", value: "{{$merchant->takeaway_tuesday_from_1}}"},
        {name: "takeaway_tuesday_till_1", value: "{{$merchant->takeaway_tuesday_till_1}}"},
        {name: "takeaway_tuesday_from_2", value: "{{$merchant->takeaway_tuesday_from_2}}"},
        {name: "takeaway_tuesday_till_2", value: "{{$merchant->takeaway_tuesday_till_2}}"},
        {name: "takeaway_wednesday_from_1", value: "{{$merchant->takeaway_wednesday_from_1}}"},
        {name: "takeaway_wednesday_till_1", value: "{{$merchant->takeaway_wednesday_till_1}}"},
        {name: "takeaway_wednesday_from_2", value: "{{$merchant->takeaway_wednesday_from_2}}"},
        {name: "takeaway_wednesday_till_2", value: "{{$merchant->takeaway_wednesday_till_2}}"},
        {name: "takeaway_thursday_from_1", value: "{{$merchant->takeaway_thursday_from_1}}"},
        {name: "takeaway_thursday_till_1", value: "{{$merchant->takeaway_thursday_till_1}}"},
        {name: "takeaway_thursday_from_2", value: "{{$merchant->takeaway_thursday_from_2}}"},
        {name: "takeaway_thursday_till_2", value: "{{$merchant->takeaway_thursday_till_2}}"},
        {name: "takeaway_friday_from_1", value: "{{$merchant->takeaway_friday_from_1}}"},
        {name: "takeaway_friday_till_1", value: "{{$merchant->takeaway_friday_till_1}}"},
        {name: "takeaway_friday_from_2", value: "{{$merchant->takeaway_friday_from_2}}"},
        {name: "takeaway_friday_till_2", value: "{{$merchant->takeaway_friday_till_2}}"},
        {name: "takeaway_saturday_from_1", value: "{{$merchant->takeaway_saturday_from_1}}"},
        {name: "takeaway_saturday_till_1", value: "{{$merchant->takeaway_saturday_till_1}}"},
        {name: "takeaway_saturday_from_2", value: "{{$merchant->takeaway_saturday_from_2}}"},
        {name: "takeaway_saturday_till_2", value: "{{$merchant->takeaway_saturday_till_2}}"},
        {name: "takeaway_sunday_from_1", value: "{{$merchant->takeaway_sunday_from_1}}"},
        {name: "takeaway_sunday_till_1", value: "{{$merchant->takeaway_sunday_till_1}}"},
        {name: "takeaway_sunday_from_2", value: "{{$merchant->takeaway_sunday_from_2}}"},
        {name: "takeaway_sunday_till_2", value: "{{$merchant->takeaway_sunday_till_2}}"}
];
    
    for (let i = 0; i < takeAwaySchedule.length; i++) {
        const takeAwayTime = takeAwaySchedule[i];
        document.querySelector("select[name='"+takeAwayTime.name+"'] option[value='"+takeAwayTime.value+"']").selected=true;      
    }







    let deliverySchedule = [
        {name: "delivery_monday_from_1", value: "{{$merchant->delivery_monday_from_1}}"},
        {name: "delivery_monday_till_1", value: "{{$merchant->delivery_monday_till_1}}"},
        {name: "delivery_monday_from_2", value: "{{$merchant->delivery_monday_from_2}}"},
        {name: "delivery_monday_till_2", value: "{{$merchant->delivery_monday_till_2}}"},
        {name: "delivery_tuesday_from_1", value: "{{$merchant->delivery_tuesday_from_1}}"},
        {name: "delivery_tuesday_till_1", value: "{{$merchant->delivery_tuesday_till_1}}"},
        {name: "delivery_tuesday_from_2", value: "{{$merchant->delivery_tuesday_from_2}}"},
        {name: "delivery_tuesday_till_2", value: "{{$merchant->delivery_tuesday_till_2}}"},
        {name: "delivery_wednesday_from_1", value: "{{$merchant->delivery_wednesday_from_1}}"},
        {name: "delivery_wednesday_till_1", value: "{{$merchant->delivery_wednesday_till_1}}"},
        {name: "delivery_wednesday_from_2", value: "{{$merchant->delivery_wednesday_from_2}}"},
        {name: "delivery_wednesday_till_2", value: "{{$merchant->delivery_wednesday_till_2}}"},
        {name: "delivery_thursday_from_1", value: "{{$merchant->delivery_thursday_from_1}}"},
        {name: "delivery_thursday_till_1", value: "{{$merchant->delivery_thursday_till_1}}"},
        {name: "delivery_thursday_from_2", value: "{{$merchant->delivery_thursday_from_2}}"},
        {name: "delivery_thursday_till_2", value: "{{$merchant->delivery_thursday_till_2}}"},
        {name: "delivery_friday_from_1", value: "{{$merchant->delivery_friday_from_1}}"},
        {name: "delivery_friday_till_1", value: "{{$merchant->delivery_friday_till_1}}"},
        {name: "delivery_friday_from_2", value: "{{$merchant->delivery_friday_from_2}}"},
        {name: "delivery_friday_till_2", value: "{{$merchant->delivery_friday_till_2}}"},
        {name: "delivery_saturday_from_1", value: "{{$merchant->delivery_saturday_from_1}}"},
        {name: "delivery_saturday_till_1", value: "{{$merchant->delivery_saturday_till_1}}"},
        {name: "delivery_saturday_from_2", value: "{{$merchant->delivery_saturday_from_2}}"},
        {name: "delivery_saturday_till_2", value: "{{$merchant->delivery_saturday_till_2}}"},
        {name: "delivery_sunday_from_1", value: "{{$merchant->delivery_sunday_from_1}}"},
        {name: "delivery_sunday_till_1", value: "{{$merchant->delivery_sunday_till_1}}"},
        {name: "delivery_sunday_from_2", value: "{{$merchant->delivery_sunday_from_2}}"},
        {name: "delivery_sunday_till_2", value: "{{$merchant->delivery_sunday_till_2}}"}
];
    
    for (let i = 0; i < deliverySchedule.length; i++) {
        const deliveryTime = deliverySchedule[i];
        document.querySelector("select[name='"+deliveryTime.name+"'] option[value='"+deliveryTime.value+"']").selected=true;      
    }

    document.querySelector("select[name='minimumWaitTime_takeaway'] option[value='{{$merchant->minimumWaitTime_takeaway}}']").selected=true;      
    document.querySelector("select[name='minimumWaitTime_delivery'] option[value='{{$merchant->minimumWaitTime_delivery}}']").selected=true;      


</script>
<script src="{{asset('js/settings.js')}}"></script>
@endsection