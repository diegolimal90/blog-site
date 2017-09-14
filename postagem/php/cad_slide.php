<?php
//error_reporting(0);
include_once("conexao/seguranca_adm.php");

//variaveis
$img		= $_FILES['foto'];
$titulo		= $_POST['titulo'];
$txt 		= $_POST['texto'];
$data		= date("Ymd");
$dat 		= date("Ymd h:i:s");
$pasta		= "../../assets/images/";

//caso não existir a pasta, criar pasta
if(!file_exists($pasta)) mkdir($pasta,0755);

//pega arquivo e mantem a extenção
if($img['tmp_name']){
	
	$ext		= strchr($img['name'],'.');

	$fmt = array('.jpg', '.jpeg', '.png');
	
	if(in_array($ext, $fmt)){
			
			$nmarquivo 	= $dat.$ext;
			move_uploaded_file($img['tmp_name'], $pasta.$nmarquivo);
			$img_up		= $nmarquivo;
			$inserir = "INSERT INTO blog (titulo, texto, img, dia) VALUES (:titulo,:txt,:img,:data)";
			$tx = utf8_decode($txt);
			$tit = utf8_decode($titulo);
			//inserindo dados no banco
			$query 	= $_SG['link'] -> prepare($inserir);
			$query->bindParam(':titulo', $tit);
			$query->bindParam(':txt', $tx);
			$query->bindParam(':img', $img_up);
			$query->bindParam(':data', $data);

			if($exec = $query -> execute()){
				echo "<script language='javascript' type='text/javascript'>alert('Cadastrado com sucesso!'); window.location.href='../painel.php'</script>";
			}else{
				echo "<script language='javascript' type='text/javascript'>alert('Cadastrado nao efetuado!'); window.location.href='../criar-post.php'</script>";
			}
			
			
		}else{
			echo "<script language='javascript' type='text/javascript'>alert('Não cadastrado. Imagem invalida!'); window.location.href='../criar-post.php'</script>";
		}			
}else{
	echo "<script language='javascript' type='text/javascript'>alert('Arquivo inválido!'); window.location.href='../criar-post.php'</script>";
}



