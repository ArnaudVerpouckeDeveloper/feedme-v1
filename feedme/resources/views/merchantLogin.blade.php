<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @csrf
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Inloggen horeca</title>

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
                <form class="login" method="POST" action="/admin/login">
                    @csrf
                    <label>E-mailadres</label>
                    <input type="email" name="email"/>
                    @error("email")
                    <p class="error">{{ $message }}</p>
                    @enderror
                    <label>Wachtwoord</label>
                    <input type="password" name="password"/>
                    @error("password")
                    <p class="error">{{ $message }}</p>
                    @enderror
                    @if(Session::has('error'))
                    <p class="error">{{Session::get('error')}}</p>
                    @endif
                    <input type="submit" value="Aanmelden"/>
                    <hr>
                    <p>Nog geen account?</p>
                    <a href="/admin/registreren">Registreren</a>
                </form>
            </div>
        </main>
    </body>
</html>
