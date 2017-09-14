<?php
//abre conexao com o banco de dados
include_once('conexao/seguranca_adm.php');

//variaveis
$user		=$_POST['user'];
$pwd		=$_POST['pwd'];
$nome 		=$_POST['nome'];
//criar comando sql
$insert	= "INSERT INTO `swvp_login` 
(`usuario`, `senha`, nome) 
VALUES ('$user', '$pwd', '$nome')";
//executa comando sql
$query = mysql_query($insert) or die();

//verifica se o comando foi executado
if(empty($query)){
	echo "<script language='javascript' type='text/javascript'>alert('Usuário não cadastrado!'); window.location.href='../cadastrar-login.php'</script>";
}else{
	echo "<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!'); window.location.href='../painel.php'</script>";	
}