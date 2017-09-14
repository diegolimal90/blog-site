<?php
//error_reporting(0);
require_once('seguranca_adm.php');

$usuario 		= $_POST['user'];
$senha_atual 	= $_POST['pwd'];
$senha_nova 	= $_POST['pwdnv'];
$senha_conf		= $_POST['pwdcf'];

$consulta_senha = "select * from NWDB_FRQ where usuario = '$usuario' and senha = '$senha_atual'";
$verifica = mysql_query($consulta_senha);

if ($verifica){
	if($senha_nova == $senha_conf){
		$snova = $senha_nova;
		$update = "UPDATE NWDB_FRQ SET usuario = '".$usuario."', senha = '".$snova."' WHERE id_frq =".$_GET['id'];	
		$query = mysql_query($update);
		if($query){
		echo "<script language='javascript' type='text/javascript'>alert('Senha atualizada com sucesso!'); window.location.href='../todos-micrifranquiados.php'</script>";
		}else{
			//echo "deu ruim";
			//print_r($_POST);
		echo "<script language='javascript' type='text/javascript'>alert('Erro!'); window.location.href='../login-franq.php?id=".$_GET['id']."'</script>";
		}
	}else{
		echo "<script language='javascript' type='text/javascript'>alert('Senha nova inválida!'); window.location.href='../login-franq.php?id=".$_GET['id']."'</script>";
	}
}else{
	echo "<script language='javascript' type='text/javascript'>alert('Senha Invalida!'); window.location.href='../login-franq.php?id=".$_GET['id']."'</script>";
}