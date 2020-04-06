<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>E-mailadres bevestigd</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body{
                font-family: Poppins, sans-serif;
                background-color: #68A25F;
            }

            h1{
                color: white;
                font-weight: 100;
                text-align: center;
                margin-top: 30vh;
                line-height: 1rem;
            }

            p{
                text-align: center;
                margin-bottom: 5rem;
                color: white;
            }

            p a{
                color: #68A25F;
                border: 2px solid white;
                padding: 0.4rem 2.3rem 0.4rem 1rem;
                text-decoration: none;
                font-size: 1.5rem;
                border-radius: 1.8rem;
                background-color: white;
                margin-left: auto;
                margin-right: auto;
                position: relative;
                border: 3px solid white;
                transition: 150ms;

            }

            p a:hover{
                background-color: #68A25F;
                color: white;
            }

            p a .text{
                margin-right: 0.5rem;
            }

            p a .material-icons{
                position: absolute;
                top:50%;
                transform: translateY(-50%);
            }


            
        </style>
    </head>
    <body>
        <h1>U bent geregistreerd.</h1>
        <p>Om verder te gaan dient u eerst uw e-mailadres te bevestigen. We hebben u een e-mail gestuurd.</p>
    </body>
</html>
