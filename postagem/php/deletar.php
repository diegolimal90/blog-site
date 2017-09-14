<?php
//error_reporting(0);
require_once('conexao/seguranca_adm.php');
//print_r($_POST);
//criar comando sql
$insert	= "DELETE FROM blog WHERE id =".$_GET['id'];
//executa comando sql
$query = $_SG['link']->prepare($insert);

//verifica se o comando foi executado
if($exe = $query -> execute()){
	echo "<script language='javascript' type='text/javascript'>alert('Post deletado!'); window.location.href='../consultar-post.php'</script>";
}else{
	echo "<script language='javascript' type='text/javascript'>alert('Post não deletado!'); window.location.href='../consultar-post.php'</script>";	
}