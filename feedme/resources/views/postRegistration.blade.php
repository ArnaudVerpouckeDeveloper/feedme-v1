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
                background-color: #4CAF50;
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
                margin-bottom: 1rem;
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

            #resendConfirmationEmail{
                font-weight: bold;
            }
            #resendConfirmationEmail:hover{
                text-decoration: underline;
                cursor: pointer;
            }


            
        </style>
    </head>
    <body>
        <h1>U bent geregistreerd.</h1>
        <p>Om verder te gaan dient u eerst uw e-mailadres te bevestigen. We hebben u een e-mail gestuurd.</p>
        <p>Geen e-mail ontvangen? <span id="resendConfirmationEmail">Opnieuw versturen</span>. </p>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function(){
                document.querySelector("#resendConfirmationEmail").addEventListener("click", async function(){
                    const response = await fetch("/api/resendConfirmEmail/"+{{$userId}}, {
                        method: "GET",
                        mode: 'cors',
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    await response.json()
                    .then(res => {
                        console.log("ok", res);
                        Swal.fire(
                            'Geslaagd!',
                            'We hebben de e-mail opnieuw verstuurd.',
                            'success'
                        );

                    })
                    .catch(error => {
                        console.log(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oei...',
                            text: "Er liep is fout bij het opnieuw versturen van de e-mail."
                        })
                    });
                });
            })
        </script>
    </body>
</html>
