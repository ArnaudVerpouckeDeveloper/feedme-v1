<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @csrf
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Merchant dashboard</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <link rel="stylesheet" type="text/css" href="{{asset('css/reset.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/index.css')}}">

        
    </head>
    <body>
        <header>
            <img class="logo" src="{{asset('images/Logo_TP_Green.png')}}" alt="logo"/>
            <nav>
                <a href="/manager/dashboard" class="{{ (request()->is('manager/dashboard')) ? 'active' : '' }}">
                    <span class="material-icons">dashboard</span>
                    Dashboard<span></span></a>
                <a href="/manager/orders" class="{{ (request()->is('manager/orders')) ? 'active' : '' }}">
                    <span class="material-icons">receipt</span>
                    Orders</a>
                <a href="/manager/producten" class="{{ (request()->is('manager/producten')) ? 'active' : '' }}">
                    <span class="material-icons">fastfood</span>
                    Producten</a>
                <a href="/manager/instellingen" class="{{ (request()->is('manager/instellingen')) ? 'active' : '' }}">
                    <span class="material-icons">settings</span>
                    Instellingen</a>
            </nav>
        </header>

        <main>  

            @yield('content')
        </main>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="{{asset('js/global.js')}}"></script>
        @yield("scripts");
    </body>
</html>