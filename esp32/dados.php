<?
require_once('config.php');


$sqlQuery = "SELECT * FROM composteira ORDER BY id";

$result = mysqli_query($conn,$sqlQuery);

$horario   = mysqli_query($conn, 'SELECT time FROM ( SELECT * FROM composteira ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');
$temperatura_chip   = mysqli_query($conn, 'SELECT temp_chip FROM ( SELECT * FROM composteira ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');
$temperatura   = mysqli_query($conn, 'SELECT temperatura FROM ( SELECT * FROM composteira ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');
$umidade   = mysqli_query($conn, 'SELECT umidade FROM ( SELECT * FROM composteira ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');

?>

    <canvas id="Temperatura"  width="400" height="200"></canvas>
    <canvas id="umidade"  width="400" height="200"></canvas>
<script>
       
       
        var tempDados = {
            labels: [<?php while ($b = mysqli_fetch_array($horario)) { echo '"' . $b['time'] . '",';}?>],
            datasets: [
            {
                label: "Temperatura do Chip",
                fill: true,
                lineTension: 0.1,
                backgroundColor: "rgba(105, 0, 132, .2)",
                borderColor: "rgba(200, 99, 132, .7)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(200, 99, 132, .7)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(200, 99, 132, .7)",
                pointHoverBorderColor: "rgba(200, 99, 132, .7)",
                pointHoverBorderWidth: 2,
                pointRadius: 5,
                pointHitRadius: 10,
                data: [<?php while ($b = mysqli_fetch_array($umidade)) { echo  $b['umidade'] . ',';}?>],
            },
            {
                label: "Temperatura ambiente", 
                fill: true,
                lineTension: 0.1,
                backgroundColor: "rgba(0, 137, 132, .2)",
                borderColor: "rgba(0, 10, 130, .7)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(0, 10, 130, .7)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(0, 10, 130, .7)",
                pointHoverBorderColor: "rgba(0, 10, 130, .7)",
                pointHoverBorderWidth: 2,
                pointRadius: 5,
                pointHitRadius: 10,
                data: [<?php while ($b = mysqli_fetch_array($temperatura)) { echo  $b['temperatura'] . ',';}?>],
            }
            ]
        };

        var graphTarget = $("#Temperatura");
                    
                    var TempGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: tempDados,
                        options: 
                            {
                                animation:
                                {
                                duration: 0
                                }
                            }
                    });


            
                    var UmidadeDados = {
            labels: [<?php while ($b = mysqli_fetch_array($horario)) { echo '"' . $b['time'] . '",';}?>],
            datasets: [
            {
                label: "Umidade",
                fill: true,
                lineTension: 0.1,
                backgroundColor: "rgba(105, 0, 132, .2)",
                borderColor: "rgba(200, 99, 132, .7)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(200, 99, 132, .7)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(200, 99, 132, .7)",
                pointHoverBorderColor: "rgba(200, 99, 132, .7)",
                pointHoverBorderWidth: 2,
                pointRadius: 5,
                pointHitRadius: 10,
                data: [<?php while ($b = mysqli_fetch_array($umidade)) { echo  $b['umidade'] . ',';}?>],
            },
            {
                label: "Temperatura ambiente", 
                fill: true,
                lineTension: 0.1,
                backgroundColor: "rgba(0, 137, 132, .2)",
                borderColor: "rgba(0, 10, 130, .7)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(0, 10, 130, .7)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(0, 10, 130, .7)",
                pointHoverBorderColor: "rgba(0, 10, 130, .7)",
                pointHoverBorderWidth: 2,
                pointRadius: 5,
                pointHitRadius: 10,
                data: [<?php while ($b = mysqli_fetch_array($temperatura)) { echo  $b['temperatura'] . ',';}?>],
            }
            ]
        };


                    var graphTargetUmidade = $("#umidade");
                    
                    var UmidadeGraph = new Chart(graphTargetUmidade, {
                        type: 'line',
                        data: UmidadeDados,
                        options: 
                            {
                                animation:
                                {
                                duration: 0
                                }
                            }
                    });

      </script>

  
