<?php
//abre conexao com o banco de dados
include_once('conexao/seguranca_adm.php');

//variaveis
$seg		=$_POST['seg'];

//criar comando sql
$iFRQ	= "INSERT INTO `swvp_segmento` (`segmento`) VALUES ('$seg')";
//executa comando sql
$qFRQ		= mysql_query($iFRQ) or die();

//verifica se o comando foi executado
if(empty($qFRQ)){
	echo "<script language='javascript' type='text/javascript'>alert('Segmento não cadastrado!'); window.location.href='../cadastrar-segmento.php'</script>";
}else{
		echo "<script language='javascript' type='text/javascript'>alert('Segmento cadastrado com sucesso!'); window.location.href='../painel.php'</script>";	
}