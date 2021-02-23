<?php

$servername = "localhost";
$username = "u952250523_Bruno";
$password = "CJCLNTiW!mtch6cy!Kuj";
$dbname = "u952250523_alimentador";




$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) die("Connection failed: " . mysqli_connect_error());


$chave_encript_produtos = "Au4FJEjq9cQKjXf76KDE9wXmWHD3buqc";

//$conn->close();


//Na hora que o alimentador ligar enviar um GET para o ESP32.php nisso ele responde com o MQTT com os horários novos...
?>