<?php
header(($_SERVER['SERVER_PROTOCOL'] ?? 'HTTP/1.0').' 503 Service Temporarily Unavailable',true,503);
header('Retry-After: 3600');
?>
<!DOCTYPE html>
<html lang="hun">
<head>
<link rel="shortcut icon" href="/admin_assets/images/kutya_title.png" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Nyomozoo.hu - Karbantartás</title>
<style type="text/css">
.nyomozoo{
  display: block;
}
html, body {
height: 100%;
margin: 0;
background: #eeeeee;
}
div {
height: 100%;
margin: 0 auto;
max-width: 700px;
display: table;
text-align: center;
}
main > * {
display:table-cell;
vertical-align: middle;
}
body
{
font: 25px tahoma, tahoma; color: #1d4b47;
}
@keyframes blink {50% { color: transparent }}
.dot { animation: 1s blink infinite }
.dot:nth-child(2) { animation-delay: 250ms }
.dot:nth-child(3) { animation-delay: 500ms }
</style>
</head>
<body>
<div>
  <img src="/admin_assets/images/logo_export_new_white.png" class="nyomozoo" alt="kep">
   <img src="/admin_assets/images/maintenance.gif" /> 
<h1>Az oldalon jelenleg karbantartást végzünk.</h1><br>
<p>Elnézést kérünk a kellemetlenségért, de átmenetileg az oldal nem érhető el. Fejlesztőink jelenleg új funkciókat építenek az oldalba, annak érdekében, hogy a lehető legjobb szolgáltatást nyújthassuk.</p><br>Kérjük látogass vissza 1 óra múlva.
<h1><span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1>
</div>
</body>
</html>