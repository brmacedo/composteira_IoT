<div id="resposta">
<?php

require_once('config.php');

if(!empty($_REQUEST['novo_valor_temp']) && !empty($_REQUEST['tipo_grafico']) && !empty($_REQUEST['tipo_range'])){

    if(is_numeric($_REQUEST['novo_valor_temp']) && is_numeric($_REQUEST['tipo_grafico']) && is_numeric($_REQUEST['tipo_range'])){

        $valorNovo = $_REQUEST['novo_valor_temp'];
        $tipo_grafico  = $_REQUEST['tipo_grafico'];
        $tipo_range  = $_REQUEST['tipo_range'];

        $configuracao   = mysqli_query($conn, " UPDATE composteira_configuracao SET tipo_exibir = ".$tipo_range." WHERE id_usuario = 1");
        switch($tipo_grafico)
        {
            case 1:
                $configuracao   = mysqli_query($conn, " UPDATE composteira_configuracao SET valores_max_temperatura = ".$valorNovo." WHERE id_usuario = 1");
            break;

            case 2:
                $configuracao   = mysqli_query($conn, " UPDATE composteira_configuracao SET valores_max_umidade = ".$valorNovo." WHERE id_usuario = 1");
            break;
        }

        echo "valores alterados para ".$valorNovo.".";
        echo "Exibição para os ".$valorNovo." últimos dados inseridos";
    }
    else{
        echo "Erro. Valor inválido!";
    }
}


if(!empty($_REQUEST['novo_valor_data']) && !empty($_REQUEST['tipo_range'])){

   

        $valorNovo = $_REQUEST['novo_valor_data'];
        $tipo_range  = $_REQUEST['tipo_range'];

        $search  = array('/');
        $replace = array('-');
        $subject = $valorNovo;
        $valorNovo = str_replace($search, $replace, $subject);
        echo "aqui: ".$valorNovo."<br /><br />";

        $inicio_grafico = substr($valorNovo,-35,16).":00";
        echo "início: ".$inicio_grafico."<br />";
        $fim_grafico  = substr($valorNovo,-16).":00";
        echo "Fim: ".$fim_grafico."<br />";

       

        $configuracao   = mysqli_query($conn, " UPDATE composteira_configuracao SET tipo_exibir = ".$tipo_range." WHERE id_usuario = 1") or die(mysqli_error());
        $configuracao   = mysqli_query($conn, " UPDATE composteira_configuracao SET timestamp_inicio = '".$inicio_grafico."' WHERE id_usuario = 1") or die(mysqli_error());
        $configuracao   = mysqli_query($conn, " UPDATE composteira_configuracao SET timestamp_fim = '".$fim_grafico."' WHERE id_usuario = 1") or die(mysqli_error());
        
            
}







?>
</div>