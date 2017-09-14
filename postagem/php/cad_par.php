<?php
//abre conexao com o banco de dados
include_once('conexao/seguranca_adm.php');

//variaveis
$nome		=$_POST['nome'];
$doc		=$_POST['doc'];
$tel		=$_POST['tel'];
$end		=$_POST['end'];
$site		=$_POST['site'];
$bairro		=$_POST['bairro'];
$cidade		=$_POST['cidade'];
$cep		=$_POST['cep'];
$uf			=$_POST['uf'];
$id_seg		=intval(strval($_POST['ordem']));

//criar comando sql
$insert	= "INSERT INTO `swvp_parceiro` 
(`nm_parceiro`, `cnpj`, `endereco`, `bairro`, `cidade`, `cep`, `estado`, `telefone`, `site`, `id_segmento`) 
VALUES ('$nome', '$doc', '$end', '$bairro','$cidade', '$cep', '$uf', '$tel', '$site', '$id_seg')";
//executa comando sql
$query = mysql_query($insert) or mysql_error();

//verifica se o comando foi executado
if(empty($query)){
	print_r($_POST);
	print_r(mysql_error());
	echo "<script language='javascript' type='text/javascript'>alert('Parceiro não cadastrado!'); window.location.href='../cadastrar-parceiro.php'</script>";
}else{
	echo "<script language='javascript' type='text/javascript'>alert('Parceiro cadastrado com sucesso!'); window.location.href='../painel.php'</script>";	
}