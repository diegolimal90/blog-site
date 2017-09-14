<?php
require_once('conexao/seguranca_adm.php');

//variaveis
$titulo		=utf8_decode($_POST['titulo']);
$txt		=utf8_decode($_POST['texto']);
$dia		=date("Y-m-d");
$dat 		= date("Ymd h:i:s");
$img		=$_FILES['foto'];
$id			=$_GET['id'];
$pasta		="../../assets/images/";


if($img['tmp_name']){
	
	$ext		= strchr($img['name'],'.');

	$fmt = array('.jpg', '.jpeg', '.png');
	
	if(in_array($ext, $fmt)){
		
			$nmarquivo 	= $dat.$ext;
			move_uploaded_file($img['tmp_name'], $pasta.$nmarquivo);
			$img_up		= $nmarquivo;

			$update = "UPDATE blog 
					   SET titulo = '".$titulo."', texto = '".$txt."', img = '".$img_up."', dia = '".$dia."'
					   WHERE id = ".$id;
			$query = $_SG['link'] -> query($update);

			if($query){
				echo "<script language='javascript' type='text/javascript'>alert('Post atualizado com sucesso!'); window.location.href='../consultar-post.php'</script>";
			}else{
				echo "<script language='javascript' type='text/javascript'>alert('Erro!'); window.location.href='../editar.php?id=".$_GET['id']."'</script>";
			}
			
			
		}else{
			echo "<script language='javascript' type='text/javascript'>alert('Não cadastrado. Imagem invalida!'); window.location.href='../editar.php?id=".$_GET['id']."'</script>";
		}			
}else{
	echo "<script language='javascript' type='text/javascript'>alert('Arquivo inválido! Formatos suportados -> .jpeg, .png, .jpg'); window.location.href='../editar.php?id=".$_GET['id']."'</script>";
}			
