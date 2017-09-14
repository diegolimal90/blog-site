<?php
/**
* sistema de segurança com acesso restrito
*
*usado para retringir o acesso de certas paginas do seu site
*
*/

//configurações do script
//========================================================================================================

$_SG['conectaServidor'] = true; //Abre uma conexao com o servidor MySQL
$_SG['abreSessao'] = true;//inicia a sessao com um session_start()

$_SG['caseSensitive'] = false;//usar case-sensitive

$_SG['validaSempre'] = true;//deseja validar o usuario e a senha a cada carregamento de pagina
//evita que, ao mudar os dados do usuario no banco de dados o mesmo continue logado

$_SG['servidor'] = 'localhost'; //servidor MySQL
$_SG['usuario'] = 'root'; //usuario MySL
$_SG['senha'] = ''; //senha MySQL
$_SG['db'] = 'nwdb_waysac'; //Bando de dados MySQL

$_SG['paginaLogin'] = 'http://localhost/waysac/login'; //pagina de login

$_SG['tabela'] = 'nwdb_cliente'; //nome da tabela onde os usuarios sao salvos
//=========================================================================================================

//=========================================================================================================
//campos fixos
//=========================================================================================================

//verifica coneção com o servidor
if ($_SG['conectaServidor'] == true){
	$_SG['link'] = mysql_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha']) or 
		die ("MySQL: Não foi possivel conectar-se ao servidor [". $_SG['servidor']."].");
	mysql_select_db($_SG['db'], $_SG['link']) or die ("Mysql: nao foi possivel comectar-se ao banco de dados");
}

//verifica se precisa iniciar a sessao
    if ($_SG['abreSessao'] == true)
       session_start();
    /**
     * Função que valida o usuario e senha
     * @param string $usuario - O usuario a ser validado
     * @param string $pwd - a senha a ser validada
     * 
     * @return bool - se o usuario e senha for valido ou nao retorna (true\False)
     */

    function validaUsuario($usuario, $pwd){
        global $_SG;

        $cS = ($_SG['caseSensitive']) ? 'BINARY' : '';
        //usa a função addslashes para escapar as aspas
        $nusuario = addslashes($usuario);
        $nsenha = addslashes($pwd);

        //monta uma consulta SQL (query) para procurar um usuario
        $sql = "SELECT ".$_SG['tabela'].".id_cliente, nwdb_frq.nome, ".$_SG['tabela'].".id_frq 
					FROM ".$_SG['tabela'].", nwdb_frq 
					WHERE ".$_SG['tabela'].".usuario = '".$nusuario."' 
					AND ".$_SG['tabela'].".senha = '".$nsenha."' 
					AND ".$_SG['tabela'].".id_frq = nwdb_frq.id_frq";
        $query = mysql_query($sql);
        $resultado = mysql_fetch_assoc($query);

        //verifica se encontrou algum registro
        if(empty($resultado)){
            //Nenhum registro foi encontrado => o usuario é invalido
            return false;
        }else{
            //definimos dois valores na sessao com os dados do usuario
            $_SESSION['usuarioID'] = $resultado['id_cliente']; //Pega o valor da coluna 'id' do registro encontrado no MySQL
            $_SESSION['usuarioNome'] = $resultado['nome'];//Pega o valor da coluna 'nm_franq' do registro encontrado no MySQL
	    $_SESSION['id_frq'] = $resultado['id_frq'];//pega o valor da coluna 'id_franq do registro encontrado no MySQL

            //verifica a opção se sempre validar o login
            if($_SG['validaSempre'] == true){
                //definimos dois valores na sessao com os dados do login
                $_SESSION['usuarioLogin'] = $usuario;
                $_SESSION['usuarioSenha'] = $pwd;
            }
            return true;
        }
    }
    /**
     * função que protege uma pagina
     */
    function protegePagina(){
        global $_SG;
        if(!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])){
            //nao ha usuario logado, muda para pagina de login
            expulsaVisitante();
        }else if(!isset ($_SESSION['usuarioID']) OR !isset ($_SESSION['usuarioNome'])){
           //Ha usuario logado, verifica se precisa validar o login novamente
            if($_SG['validaSempre'] == true){
                //verifica se os dados salvos na sessao batem com os dados do banco de dados
                if(!validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'])){
                    //os dados nao batem manda para a tela de login
                    expulsaVisitante();
                }
            }
        }
    }
    /**
     * Função expulsar um visitante
     */
    function expulsaVisitante(){
        global $_SG;
        
        //remove as variaveis da sessao(caso elas existam)
        unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);
        
        //manda para a tela de login
        header('Location:'.$_SG['paginaLogin']);
    }
?>