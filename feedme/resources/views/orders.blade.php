<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Orders</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        
    </head>
    <body>
        <h1>Sockets test</h1>
        @csrf
      <script src="{{asset('js/app.js')}}"></script>
      <script>
          /*
          window.Echo = new Echo({
            broadcaster: 'pusher',
            key: 'myKey',
            wsHost: window.location.hostname,
            wsPort: 6005,
            //disableStats: true,
            
            auth: {
                params: {
                CSRFToken: document.querySelector('input[name="_token"]').value
                }
            }
        
        });
        */

          //let myToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4NDcwMjQ0MywiZXhwIjoxNTg0NzA2MDQzLCJuYmYiOjE1ODQ3MDI0NDMsImp0aSI6InZ2SnNiQ0ZtNG9SSkxHRGwiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.Hyxuz_Xla5XJsi6AW8hg2unp0WirAS0VW6IsxMuWh08";
          //Echo.private("orders."+"1")
          Echo.private("orders")
          .listen("NewOrder", (e) => {
              console.log(e);
          })
      </script>
    </body>
</html>
