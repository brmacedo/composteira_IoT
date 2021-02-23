<?php
require_once 'config.php';
require_once 'function.php';

       
if(!empty($_REQUEST['id_sensor'])){
		date_default_timezone_set('America/Sao_Paulo');
        $data = date("Y-m-d H:i:s");
        $id_sensor = $_REQUEST['id_sensor'];
        $temperatura = ($_REQUEST['temperatura']/100);
        $temp_chip = ($_REQUEST['temp_chip']/100);
        $umidade = ($_REQUEST['umidade']/100);
        $pressao = ($_REQUEST['pressao']/100);
        $altitude = ($_REQUEST['altitude']/100);
        $solo = ($_REQUEST['solo']);

        $sql = $conn->query("INSERT INTO composteira(id_sensor, time, temperatura, temp_chip, umidade, pressao, solo, altitude) VALUES ('".$id_sensor."', '".$data."', '".$temperatura."', '".$temp_chip."', '".$umidade."', '".$pressao."' , '".$solo."' , '".$altitude."')") or die(mysqli_error());
		//echo $sql."adicionado com sucesso";
}
else{
  //  echo "campo vazio";
}



$conn->close();
?>