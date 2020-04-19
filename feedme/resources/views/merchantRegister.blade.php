<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @csrf
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Registreren horeca</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <link rel="stylesheet" type="text/css" href="{{asset('css/reset.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/index.css')}}">
    </head>
    <body class="green-bg">
        <main>
            <div class="merchantAuthPanel">
                <img class="logo" src="{{asset('images/Logo_TP_Green.png')}}" alt="logo"/>
                <form class="register" method="POST" action="/admin/registreren">
                    @csrf
                    <label>E-mailadres</label>
                    <input type="email" name="email" required value="{{ old('email') }}"/>
                    @error("email")
                    <p class="error">{{ $message }}</p>
                    @enderror


                    <label>Wachtwoord</label>
                    <input type="password" required name="password" />
                    <p class="information">Minstens 1 hoofdletter, minstens 1 teken, minstens 1 cijfer en een minimumlengte van 8 tekens.</p>
                    @error("password")
                    <p class="error">{{ $message }}</p>
                    @enderror


                    <label>Herhaal wachtwoord</label>
                    <input type="password" required name="password_confirmation"/>
                    @error("password_confirmation")
                    <p class="error">{{ $message }}</p>
                    @enderror

                    <label>Voornaam</label>
                    <input type="text" name="firstName" required value="{{ old('firstName') }}"/>
                    @error("firstName")
                    <p class="error">{{ $message }}</p>
                    @enderror

                    <label>Naam</label>
                    <input type="text" name="lastName" required value="{{ old('lastName') }}"/>
                    @error("lastName")
                    <p class="error">{{ $message }}</p>
                    @enderror

                    <label>Persoonlijk GSM-nummer</label>
                    <input type="text" name="mobilePhone" required value="{{ old('mobilePhone') }}"/>
                    @error("mobilePhone")
                    <p class="error">{{ $message }}</p>
                    @enderror

                    <label>Naam horecazaak</label>
                    <input type="text" name="merchantName" required value="{{ old('merchantName') }}"/>
                    @error("merchantName")
                    <p class="error">{{ $message }}</p>
                    @enderror

                    <label>Straat</label>
                    <input type="text" name="address_street" required value="{{ old('address_street') }}"/>
                    @error("address_street")
                    <p class="error">{{ $message }}</p>
                    @enderror

                    <label>Nummer</label>
                    <input type="text" name="address_number" required value="{{ old('address_number') }}"/>
                    @error("address_number")
                    <p class="error">{{ $message }}</p>
                    @enderror

                    <label>Postcode</label>
                    <input type="value" name="address_zip" required value="{{ old('address_zip') }}"/>
                    @error("address_zip")
                    <p class="error">{{ $message }}</p>
                    @enderror

                    <label>Stad</label>
                    <input type="text" name="address_city" required value="{{ old('address_city') }}"/>
                    @error("address_city")
                    <p class="error">{{ $message }}</p>
                    @enderror

                    <label>Telefoonnummer horecazaak</label>
                    <input type="text" name="merchantPhone" required value="{{ old('merchantPhone') }}"/>
                    @error("merchantPhone")
                    <p class="error">{{ $message }}</p>
                    @enderror

                    <label>BTW nummer</label>
                    <input type="text" name="tax_number" required value="{{ old('tax_number') != null ? old('tax_number') : "BE 0000.000.000" }}" placeholder="BE 0000.000.000"/>
                    @error("tax_number")
                    <p class="error">{{ $message }}</p>
                    @enderror

                    <div class="acceptsTermsAndConditions">
                        <input type="checkbox" name="acceptsTermsAndConditions" required/>
                        <label>Ik ga akkoord met de <a href="/voorwaarden" target="_blank">algemene voorwaarden</a></label>
                    </div>
                    @error("acceptsTermsAndConditions")
                        <p class="error">{{ $message }}</p>
                    @enderror
                    

                    @if(Session::has('error'))
                    <p class="error">{{Session::get('error')}}</p>
                    @endif


                    <input type="submit" value="Registreren als horecazaak"/>
                    <hr>
                    <p>Heeft u al een account?</p>
                    <a href="/admin/login">Aanmelden</a>
                </form>
            </div>
        </main>
    </body>
</html>
