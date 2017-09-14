<?php
error_reporting(0);
require_once('conexao/seguranca_adm.php');

$nome		=$_POST['nome'];
$doc		=$_POST['doc'];
$tel		=$_POST['tel'];
$email		=$_POST['email'];
$skype		=$_POST['skype'];
$id_pln		=intval(strval($_POST['plano']));
$id_pag		=2;


$update = "UPDATE NWDB_FRQ 
		   SET nm_frq = '".$nome."', tel = '".$tel."', email = '".$email."', doc = '".$doc."', skype = '".$skype."', id_tpfrq = '".$id_pln."' 
		   WHERE id_franq =".$_GET['id'];
			
$query = mysql_query($update);
if($query){
echo "<script language='javascript' type='text/javascript'>alert('Franqueado atualizado com sucesso!'); window.location.href='../todos-micrifranqueados.php'</script>";
}else{
	//echo "deu ruim";
	//print_r($_POST);
echo "<script language='javascript' type='text/javascript'>alert('Erro!'); window.location.href='../editar-franq.php?id=".$_GET['id']."'</script>";
}