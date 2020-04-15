<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        @csrf
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>404</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <link rel="stylesheet" type="text/css" href="{{asset('css/reset.css')}}">
        <style>
            body{
                background-color: #4CAF50;
                font-family: "Poppins", sans-serif;
                text-align: center;
            }
            h1{
                font-size: 15rem;
                color: white;
                font-weight: bold;
                margin-top: 10rem;
                margin-bottom: 4rem;
            }
            p{
                font-size: 2rem;
                color: white;
                margin-bottom: 6rem;
            }
            a{
                text-transform: uppercase;
                font-size: 1.5rem;
                padding: 0.5rem 2rem;
                border-radius: 2rem;
                font-weight: bold;
                color: white;
                border: 4px solid white;
                background-color: rgba(255,255,255,0.15);
            }
            a:hover{
                background-color: white;
                color: #4CAF50;
            }
            @media only screen and (max-width: 1000px) {
                h1{
                    font-size: 6rem;
                    margin-bottom: 3rem
                }
                p{
                    font-size: 1.3rem;
                    margin-bottom: 3rem
                }
                a{
                    font-size: 1rem;
                    padding: 0.25rem 1rem;
                    border: 2px solid white;
                }
            }

            @media only screen and (max-width: 500px) {
                h1{
                    font-size: 5rem;
                    margin-bottom: 3rem
                }
                p{
                    font-size: 1rem;
                    margin-bottom: 3rem;
                    width: 80%;
                    margin-left: auto;
                    margin-right: auto;
                }
                a{
                    font-size: 1rem;
                    padding: 0.25rem 1rem;
                    border: 2px solid white;
                }
            }

        </style>
    </head>
    <body class="green-bg">
        <main>
            <h1>Oeps!</h1>
            <p>De pagina die u zoekt, kon niet gevonden worden.</p>
            <a href="/">Startpagina</a>
        </main>
    </body>
</html>
