<!DOCTYPE html>
<html>
<head>
  <title>Nieuw contactformulier</title>
</head>
<body style="font-family:Poppins,sans-serif;padding:2rem;">
<p style="margin-bottom: 0.5rem; margin-top:0; font-weight: bold; width: 10rem;">Volledige naam: <span style="font-weight:normal;">{{$validatedData["fullName"]}}</span></p>
<p style="margin-bottom: 0.5rem; margin-top:0; font-weight: bold; width: 10rem;">Emailadres:: <span style="font-weight:normal;">{{$validatedData["email"]}}</span></p>
<p style="margin-bottom: 0.5rem; margin-top:0; font-weight: bold; width: 10rem;">Bericht:</p>
<p>{{$validatedData["message"]}}</p>

</body>
</html>