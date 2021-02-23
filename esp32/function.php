<?php
include 'config.php';

function anti_injection($sql)
{
// remove palavras que contenham sintaxe sql
$sql = preg_replace(preg_quote("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
$sql = trim($sql);//limpa espaços vazio
$sql = strip_tags($sql);//tira tags html e php
$sql = addslashes($sql);//Adiciona barras invertidas a uma string
return $sql;
}

function protecao_info($ID_ParaFazerHash,$sal){
		
		$palavra_secreta = "s#C2Ea2mAF.L4V9q&kP@AYPWoHtaZj.3";
		$hash = md5(base64_encode($palavra_secreta).base64_encode($ID_ParaFazerHash).base64_encode($sal));
		
		for ($i = 0; $i < 1000; $i++) {
			$hash = md5($hash);
		}
		
		return $hash;

}

function geraSalAleatorio() {
	return substr(sha1(mt_rand()), 0, 16);  
}

?>