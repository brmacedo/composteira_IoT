<?
require_once('config.php');


$configuracao   = mysqli_query($conn, "SELECT * FROM composteira_configuracao WHERE id_usuario = 1 ");

while ($b = mysqli_fetch_array($configuracao)) 
    {
        $qtd_exb_valores = $b['valores_max_umidade'];
        $tipo_grafico = $b['tipo_exibir'];
        $inicio_grafico = $b['timestamp_inicio'];
        $fim_grafico = $b['timestamp_fim'];
    }

if($tipo_grafico == 1){
    echo "<center>exibindo os últimos ".$qtd_exb_valores." valores</center>"; 
    $horario   = mysqli_query($conn, 'SELECT time FROM ( SELECT * FROM composteira ORDER BY id DESC LIMIT '.$qtd_exb_valores.') Var1 ORDER BY ID ASC');
    $umidade   = mysqli_query($conn, 'SELECT umidade FROM ( SELECT * FROM composteira ORDER BY id DESC LIMIT '.$qtd_exb_valores.') Var1 ORDER BY ID ASC');
}
else{
    echo "<center>exibindo dados de ".$inicio_grafico." até ".$fim_grafico." </center>";
    $horario   = mysqli_query($conn, 'SELECT time FROM ( SELECT * FROM composteira WHERE time BETWEEN "'.$inicio_grafico.'" AND "'.$fim_grafico.'" ORDER BY id DESC) Var1 ORDER BY ID ASC');
    $umidade   = mysqli_query($conn, 'SELECT umidade FROM (SELECT * FROM composteira WHERE time BETWEEN "'.$inicio_grafico.'" AND "'.$fim_grafico.'" ORDER BY id DESC) Var1 ORDER BY ID ASC');
}

?>

    <canvas id="umidade"  width="400" height="200"></canvas>

<script>
       
       
        var tempDados = {
            labels: [<?php while ($b = mysqli_fetch_array($horario)) { echo '"' . $b['time'] . '",';}?>],
            datasets: [
            {
                label: "Umidade Relativa do ar (%)", 
                fill: true,
                lineTension: 0.1,
                backgroundColor: "rgba(0, 50, 132, .3)",
                borderColor: "rgba(0, 10, 130, .7)",
                borderCapStyle: 'round',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'round',
                pointBorderColor: "rgba(0, 100, 30, .7)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(0, 10, 130, .7)",
                pointHoverBorderColor: "rgba(0, 10, 130, .7)",
                pointHoverBorderWidth: 1,
                pointRadius: 0,
                pointHitRadius: 1,
                
                data: [<?php while ($b = mysqli_fetch_array($umidade)) { echo  $b['umidade'] . ',';}?>],
            }
            ]
        };

        var graphTarget = $("#umidade");
                    
                    var TempGraph = new Chart(graphTarget, {
                        
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
                                            suggestedMax: 60,
                                            suggestedMin: 40,
                                        }
                                    }]
                                }

                                
                        },

                        type: 'line',                        
                        data: tempDados,  
                        

                    });

                    

      </script>

  
