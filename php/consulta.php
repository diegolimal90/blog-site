<?php
	header("Content-Type: text/plain");
	//include ('postagem/php/conexao/seguranca_adm.php');
	$retorno = array();
	$DB = new PDO('mysql:host=blueindico-blog.mysql.uhserver.com;dbname=blueindico_blog;','user_blog','blue.indico16', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

	if($DB){
		$consulta 	= "Select * from blog";
		$query 		= $DB -> query($consulta);

			while($res = $query -> fetch()) {
				$txt = $res['texto'];
				$retorno[]= array(
				'id' 		=> $res['id'],
				'dia' 		=> $res['dia'],
				'titulo'	=> $res['titulo'],
				'img'		=> $res['img'],
				'texto'		=> $txt);
			}
			
			$json = json_encode($retorno);
			echo $json;
	}else{
		$conexao = "Não estamos conectado ao Banco de Dados";
	}

