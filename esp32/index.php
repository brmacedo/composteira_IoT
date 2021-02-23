<?php

$date = date_create();
$date = date_timestamp_get($date);
?>
<!DOCTYPE html>
<html>
<head>
<title>Composteira IoT</title>
<link rel="shortcut icon" href="img/worm.png" />
<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" >
<link rel="stylesheet" href="css/jquery-ui.css">
 <link rel="stylesheet" href="css/default.css<?php echo"?v=".$date?>" >
 <link rel="stylesheet" href="css/main.css<?php echo"?v=".$date?>" >

 <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script> 
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/evil-icons@1.9.0/assets/evil-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/evil-icons@1.9.0/assets/evil-icons.min.js"></script>

<!-- <script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script> -->
<script type="text/javascript" src="js/chart.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1">

<?php

//Fonte tutorial: https://phppot.com/php/creating-dynamic-data-graph-using-php-and-chart-js/
?>



<script>
var refreshId = setInterval(function()
{
  $('#ContainerTemperatura').load('dados_temperatura.php');
  $('#ContainerUmidade').load('dados_umidade.php');
  $('#ContainerPressao').load('dados_pressao.php');
  $('#ContainerSolo').load('dados_solo.php');
}, 11000);


$(document).ready(function() {
  $('#ContainerTemperatura').load('dados_temperatura.php');
  $('#ContainerUmidade').load('dados_umidade.php');
  $('#ContainerPressao').load('dados_pressao.php');
  $('#ContainerSolo').load('dados_solo.php');
  $("#configura_graficos").hide();
});


</script>

<script>
  $( function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "fade",
        duration: 1000
      },
      hide: {
        effect: "fade",
        duration: 1000
      }
    });
 
    $( "#opener" ).on( "click", function() {
      $( "#dialog" ).dialog( "open" );
    });
    });


    
  
  </script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Composteira IoT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="?p=1"><div data-icon="ei-chart" data-size="s"></div>Gráfico</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?p=2"><div data-icon="ei-pencil" data-size="s"></div>Artigo</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div data-icon="ei-navicon" data-size="s"></div>Menu
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" class="form-control form-control-sm" href="#" id="mostra_conf_graf" ><div data-icon="ei-gear" data-size="s"></div> Configurar</a>
          <a class="dropdown-item" class="form-control form-control-sm" href="#" id = "opener"><div data-icon="ei-question" data-size="s"></div> Sobre</a>
            

        </div>
      </li>
    </ul>
  </div>
</nav>



          
          
              <div id='configura_graficos'>
               <form action="altera_valores_exibir.php" id="AtualizaRangeData" class="form-inline">
               
                       <input type="hidden" value="2" name="tipo_range">
                       <input class= "form-control mb-4 mr-sm-4" type="text" name="novo_valor_data" />
                     
                    
                      <input type="submit" value="Atualizar" id="esconde_configura_graficos2" class="btn btn-primary mb-2">
                    
                
                  </form>
                <script>
                    $(function() {
                      $('input[name="novo_valor_data"]').daterangepicker({
                        "showWeekNumbers": true,
                        "timePicker24Hour": true,
                        "opens": "center",                        
                        startDate: moment().startOf('hour'),
                        timePicker: true,
                        "maxSpan": {
                              "days": 2
                          },
                          
                          "weekLabel": "S",
                        endDate: moment().startOf('hour').add(32, 'hour'),
                        locale: {
                          format: 'YYYY/MM/DD HH:mm',
                          "daysOfWeek": [
                            "Dom",
                            "Seg",
                            "Ter",
                            "Qua",
                            "Qui",
                            "Sex",
                            "Sáb"
                        ],
                        "monthNames": [
                          "Janeiro",
                          "Fevereiro",
                          "Março",
                          "Abril",
                          "Maio",
                          "Junho",
                          "Julho",
                          "Agosto",
                          "Setembro",
                          "Outubro",
                          "Novembro",
                          "Dezembro"
                    ],
                        }
                      });
                    });
                    </script>
                    <script>



                </script>





                    <form action="altera_valores_exibir.php" id="AtualizaCampo">
                    <div class="row">
                    <div class="col">
                      <select name="tipo_grafico"  class="form-control mb-2 mr-sm-2">
                        <option selected value="1">Temperatura</option>
                        <option value="2">Umidade</option>                      
                      </select>
                    </div>
                      <div class="col">
                       <input type="number" name="novo_valor_temp" placeholder="Valor novo"  class="form-control mb-2 mr-sm-2">
                        <input type="hidden" value="1" name="tipo_range">
                      </div>
                      <div class="col">
                        <input type="submit" value="Atualizar" id="esconde_configura_graficos" class="btn btn-primary"> 
                      </div>
                      </div>
                      
                    
                    </form>
                    <!-- the result of the search will be rendered inside this div -->
                    
                </div>
                
               <script>
                
                window.onload = function()
                {
                  // Attach a submit handler to the form
                $( "#AtualizaCampo" ).submit(function( event ) {
               
                  // Stop form from submitting normally
                  event.preventDefault();
                
                  // Get some values from elements on the page:
                  var $form = $( this ),
                    term = $form.find( "input[name='novo_valor_temp']" ).val(),
                    term2 = $form.find( "select[name='tipo_grafico']" ).val(),
                    term3 = $form.find( "input[name='tipo_range']" ).val(),
                    url = $form.attr( "action" );
                    /*console.log(term);
                    console.log(term2);*/
                  // Send the data using post
                  var posting = $.get( url, { novo_valor_temp: term,  tipo_grafico: term2,  tipo_range: term3} );
                
                  // Put the results in a div
                  posting.done(function( data ) {
                    var content = $( data ).find( "#resposta" );
                    $( "#Resultado_Atualizacao" ).empty().append( content );
                    $('#ContainerTemperatura').load('dados_temperatura.php');
                    $('#ContainerUmidade').load('dados_umidade.php');
                    $('#ContainerSolo').load('dados_solo.php');
                  });
                });


                $( "#AtualizaRangeData" ).submit(function( event ) {
                  
                  // Stop form from submitting normally
                  event.preventDefault();
                
                  // Get some values from elements on the page:
                  var $form = $( this ),
                    term = $form.find( "input[name='novo_valor_data']" ).val(),
                    term2 = $form.find( "input[name='tipo_range']" ).val(),
                    url = $form.attr( "action" );
                    console.log(term);
                    console.log(term2);
                  // Send the data using post
                  var posting = $.get( url, { novo_valor_data: term,  tipo_range: term2} );
                
                  // Put the results in a div
                  posting.done(function( data ) {
                    var content = $( data ).find( "#resposta" );
                    $( "#Resultado_Atualizacao" ).empty().append( content );
                    $('#ContainerTemperatura').load('dados_temperatura.php');
                    $('#ContainerUmidade').load('dados_umidade.php');
                    $('#ContainerSolo').load('dados_solo.php');
                  });
                });

              };
                </script>
                <div id="Resultado_Atualizacao"> </div>

<script>
$("#mostra_conf_graf").click(function(){
      $("#configura_graficos").show(500);
    });

$("#esconde_configura_graficos").click(function(){
  $("#configura_graficos").hide(500);
});

$("#esconde_configura_graficos2").click(function(){
  $("#configura_graficos").hide(500);
});

    
</script>                

<?php
if(!empty($_GET['p']))
{
  $pagina = $_GET['p'];
}
else{
  $pagina = 1;
}
  switch($pagina)
  {
    default:
    case 1:
      echo '
        <div id = "ContainerTemperatura" class="espaco_grafico"></div>
        <div id = "ContainerUmidade" class="espaco_grafico"></div>
        <div id = "ContainerSolo" class="espaco_grafico"></div>
        <div id = "ContainerPressao" class="espaco_grafico"></div>
        ';    
    break;
      
    case 2:

    break;

  }

 ?>          

  
<div id="dialog" title="Sobre">
    <p>
        Composteira IoT<br />
        Dados sobre a saude geral da composteira<br />
        Bibliotecas:<br />
        <a href="https://getbootstrap.com/" target="_blank">Chart.js    </a> <br />
        <a href="https://getbootstrap.com/" target="_blank">Bootstrap   </a> <br />
        <a href="https://jquery.com/"       target="_blank">jQuery      </a> <br />
        <a href="https://jqueryui.com/"     target="_blank">jQuery UI   </a> <br />
        <a href="https://evil-icons.io/"    target="_blank">Evil Icons  </a> <br />
        <a href="https://www.freepik.com"   target="_blank">Freepik     </a> <br />

    </p>
</div>


<div class="main-footer text-center rodape">
      Criado por Bruno Macedo 2021
</div>


</body>

</html>




