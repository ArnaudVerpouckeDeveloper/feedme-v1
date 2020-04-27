<!DOCTYPE html>
<html>
<head>
  <title>Nieuwe horecazaak geregistreerd</title>
</head>
<body style="font-family:Poppins,sans-serif;padding:2rem;">
<h1 style="font-size: 2rem;color:black;margin-top:0;">Er heeft zich een nieuwe horecazaak geregistreerd!</h1>

<ul style="margin-bottom: 3rem; padding: 0;">
  <li style="display: flex;"><p style="width: 12rem; margin:0;">Naam horecazaak:</p><p style="margin:0;">{{$merchant->name}}</p></li>
  <li style="display: flex;"><p style="width: 12rem; margin:0;">API naam:</p><p style="margin:0;">{{$merchant->apiName}}</p></li>
  <li style="display: flex;"><p style="width: 12rem; margin:0;">Tel. horecazaak:</p><p style="margin:0;">{{$merchant->merchantPhone}}</p></li>
  <li style="display: flex;"><p style="width: 12rem; margin:0;">Adres:</p><p style="margin:0;">{{$merchant->address_street}} {{$merchant->address_number}}, {{$merchant->address_zip}} {{$merchant->address_city}}</p></li>
  <li style="display: flex;"><p style="width: 12rem; margin:0;">BTW nummer:</p><p style="margin:0;">{{$merchant->tax_number}}</p></li>
  <br>
  <br>
  <li style="display: flex;"><p style="width: 12rem; margin:0;">Voornaam:</p><p style="margin:0;">{{$user->firstName}}</p></li>
  <li style="display: flex;"><p style="width: 12rem; margin:0;">Familienaam:</p><p style="margin:0;">{{$user->lastName}}</p></li>
  <li style="display: flex;"><p style="width: 12rem; margin:0;">Emailadres:</p><p style="margin:0;">{{$user->email}}</p></li>
  <li style="display: flex;"><p style="width: 12rem; margin:0;">GSM nummer:</p><p style="margin:0;">{{$user->mobilePhone}}</p></li> 
</ul>

<p style="margin-bottom: 0;">Met vriendelijke groeten</p>
<p style="margin-bottom:1rem;margin-top: 0;">Team SpeedMeal</p>
</body>
</html>