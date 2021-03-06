@php
    $confirmationLink = "https://www.speedmeal.be/confirm-email/".$user->verificationCode;
@endphp 

<!DOCTYPE html>
<html>
<head>
  <title>Bevestig uw emailadres</title>
</head>
<body style="font-family:Poppins,sans-serif;padding:2rem;">
<h1 style="font-size: 2rem;color:black;margin-top:0;">Welkom {{$user->firstName}}!</h1>
<p>Gelieve uw e-mailadres te bevestigen door op onderstaande knop de drukken:</p>
<a href="{{$confirmationLink}}" style="padding:0.5rem 1rem;background-color:#4CAF50;color:white;font-size: 1rem;font-weight:600;border-radius:0.3rem;text-decoration:none;margin-bottom:1rem;display:inline-block;text-transform:uppercase;">bevestig e-mail</a>
<p>Indien er zich een probleem zou voordoen, dan kunt u manueel naar de link navigeren:</p>
@if($showManualSectionInEmail)
  <a href="{{$confirmationLink}}" style="color:grey;margin-bottom:1rem;display:inline-block;font-size:1rem !important;">{{$confirmationLink}}</a>
  <p style="color:red;margin-bottom:2rem;">Tip: bij problemen kunt u steeds de <a style="color:red;font-weight:bold;" href="https://www.speedmeal.be/handleiding-voor-horecazaken">handleiding voor horecazaken</a> raadplegen.</a></p>
@else
  <a href="{{$confirmationLink}}" style="color:grey;margin-bottom:2rem;display:inline-block;font-size:1rem !important;">{{$confirmationLink}}</a>
@endif

<p style="margin-bottom: 0;">Met vriendelijke groeten</p>
<p style="margin-bottom:1rem;margin-top: 0;">Team SpeedMeal</p>
</body>
</html>