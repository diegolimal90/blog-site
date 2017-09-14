<?php
include_once('conexao/seguranca_adm.php');
//verifica se um formulario foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	//salva duas variaveis com o que foi digitado no form
	//detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
	$usuario = (isset($_POST['user'])) ? $_POST['user'] : '';
	$pwd = (isset($_POST['pwd'])) ?  $_POST['pwd'] : '';
	//utiliza uma função criada no arquivo seguranca.php para validar os campos digitados
	if(validaUsuario($usuario, $pwd) == true){
		//caso os campos forem validos abre a tela inicial do sistema
		header('Location: ../painel.php');
	}else{
		//caso um dos campos nao sao validos retorna ao menu
		//alterar o url de redirecionamento em seguranca.php
		expulsaVisitante();
	}
}
?>