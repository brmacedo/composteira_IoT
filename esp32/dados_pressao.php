<?
require_once('config.php');


$sqlQuery = "SELECT * FROM composteira ORDER BY id";

$result = mysqli_query($conn,$sqlQuery);

$horario   = mysqli_query($conn, 'SELECT time FROM ( SELECT * FROM composteira ORDER BY id DESC LIMIT 50) Var1 ORDER BY ID ASC');
//$temperatura_chip   = mysqli_query($conn, 'SELECT temp_chip FROM ( SELECT * FROM composteira ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');
$pressao   = mysqli_query($conn, 'SELECT pressao FROM ( SELECT * FROM composteira ORDER BY id DESC LIMIT 50) Var1 ORDER BY ID ASC');
//$umidade   = mysqli_query($conn, 'SELECT umidade FROM ( SELECT * FROM composteira ORDER BY id DESC LIMIT 20) Var1 ORDER BY ID ASC');

?>

    <canvas id="pressao"  width="400" height="200"></canvas>
    
<script>
       
       
        var tempDados = {
            labels: [<?php while ($b = mysqli_fetch_array($horario)) { echo '"' . $b['time'] . '",';}?>],
            datasets: [
            {
                label: "Pressão (hPa)", 
                fill: true,
                lineTension: 0.1,
                backgroundColor: "rgba(10, 150, 0, .2)",
                borderColor: "rgba(10, 150, 0, .7)",
                borderCapStyle: 'round',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'round',
                pointBorderColor: "rgba(10, 150, 40, .7)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(10, 150, 60, .7)",
                pointHoverBorderColor: "rgba(10, 150, 60, .7)",
                pointHoverBorderWidth: 1,
                pointRadius: 0,
                pointHitRadius: 1,
                data: [<?php while ($b = mysqli_fetch_array($pressao)) { echo  $b['pressao'] . ',';}?>],
            }
            ]
        };

        var graphTarget = $("#pressao");
                    
                    var TempGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: tempDados,
                        options: 
                            {
                                animation:
                                {
                                duration: 0
                                },

                                scales:
                                {
                                    yAxes: [{
                                        ticks: {
                                            //beginAtZero: true
                                            suggestedMax: 955,
                                            suggestedMin: 935,
                                        }
                                    }]
                                }

                            }


                    });


            
                    

      </script>

  
