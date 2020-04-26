<!DOCTYPE html>
<html lang=nl>

<head>
  <meta charset=utf-8>
  <meta http-equiv=X-UA-Compatible content="IE=edge">
  <meta name=viewport content="width=device-width,initial-scale=1">
  <!-- Primary Meta Tags -->
  <title>Speed Meal</title>
  <META NAME="Description"
    CONTENT="SpeedMeal biedt restauranten een gratis systeem aan waarmee online eten besteld kan worden.">

  <meta name="title" content="Speed Meal">
  <meta name="description"
    content="SpeedMeal biedt restauranten een gratis systeem aan waarmee online eten besteld kan worden.">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.speedmeal.be/">
  <meta property="og:title" content="Speed Meal">
  <meta property="og:description"
    content="SpeedMeal biedt restauranten een gratis systeem aan waarmee online eten besteld kan worden.">
  <meta property="og:image" content="{{asset('spa/assets/images/linkpreview.png')}}">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="https://www.speedmeal.be/">
  <meta property="twitter:title" content="Speed Meal">
  <meta property="twitter:description"
    content="SpeedMeal biedt restauranten een gratis systeem aan waarmee online eten besteld kan worden.">
  <meta property="twitter:image" content="{{asset('spa/assets/images/linkpreview.png')}}">

  <link rel=stylesheet href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900">
  <link rel=stylesheet href=https://cdn.jsdelivr.net/npm/@mdi/font@latest/css/materialdesignicons.min.css>
  <link rel=icon type=image/png href="{{asset('spa/assets/images/favicon.png')}}">
  <meta name=theme-color content=#4CAF50>
  <link href="{{asset('spa/app.css')}}" rel=preload as=style>
  <link href="{{asset('spa/app.js')}}" rel=preload as=script>
  <link href="{{asset('spa/chunk-vendors.js')}}" rel=preload as=script>
  <link href="{{asset('spa/chunk-vendors.css')}}" rel=preload as=style>
  <link href="{{asset('spa/chunk-vendors.css')}}" rel=stylesheet>
  <link href="{{asset('spa/app.css')}}" rel=stylesheet>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-163996040-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'UA-163996040-1');
  </script>
</head>

<body><noscript><strong>We're sorry but frontend doesn't work properly without JavaScript enabled. Please enable it to
      continue.</strong></noscript>
  <div id=app></div>
  <script src="{{asset('spa/chunk-vendors.js')}}"></script>
  <script src="{{asset('spa/app.js')}}"></script>
</body>

</html>