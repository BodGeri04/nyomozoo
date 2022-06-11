<!doctype html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatibile" content="ie=edge">
    <title>-Nyomozoo.hu- Felhasználói üzenet</title>
    <img src="https://nyomozoo.hu/admin_assets/images/logo_export_new_white.png" alt="Nyomozoo Logo">
</head>

<body>
    <strong><label>Kapcsolatfelvevő adatai<label></strong>
    <p><strong>Név: </strong>{{ $dataRecived['name'] }}</p>
    <p><strong>Email: </strong>{{ $dataRecived['email'] }}</p>
    <p><strong>Telefonszám: </strong>{{ $dataRecived['phone'] }}</p>
    <hr>
    <h4>Üzenet:</h4>
    {{ $dataRecived['message'] }}
    <br>
</body>
<br>
<hr>
<footer>
    <strong>Kérjük erre a címre ne válaszolj! Ha fel szeretnéd venni a kapcsolatot a feladóval, használd az "Email" sorban található címet. </strong>
</footer>
</html>
