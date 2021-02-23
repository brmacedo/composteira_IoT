<?php

$servername = "SERVER";
$username = "USERNAME";
$password = "PASSWORD";
$dbname = "DABASE_NAME";




$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) die("Connection failed: " . mysqli_connect_error());


//$conn->close();
?>
