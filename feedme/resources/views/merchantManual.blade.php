<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @csrf
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Handleiding voor horecazaken</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <link rel="stylesheet" type="text/css" href="{{asset('css/reset.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/index.css')}}">
        
        <style>
            .handleiding{
                margin-top: 10rem;
                width: 400px;
                background-color: white;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
                height: 170px;
                border-radius: 0.3rem;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-top: 50%;
                transform: translateY(-50%);
                transition: all 300ms;
            }
            .handleiding:hover{
                cursor: pointer;
            }
            .handleiding:hover a{
                text-decoration: underline;
            }
            .handleiding a{
                text-align: center;
                font-weight: bold;
                font-size: 1.5rem;
                color: #4CAF50;
                transition: all 300ms;
            }

            @media only screen and (max-width: 500px) {
                .handleiding{
                    width: 95%;
                    
                    margin-top: 0;
                    transform: unset;
                    
                }

                .handleiding a{
                    font-size: 1.2rem;
                }

            }
        </style>
    </head>
    <body class="green-bg">
        <main>
            <p class="handleiding"><a href="{{ asset('documents/Handleiding_Voor_Horecazaken_SpeedMeal.pdf') }}" target="_blank">Open handleiding</a></p>
        </main>
    </body>
</html>
