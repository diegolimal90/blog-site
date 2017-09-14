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

$_SG['servidor'] = 'blueindico-blog.mysql.uhserver.com'; //servidor MySQL
$_SG['usuario'] = 'user_blog'; //usuario MySL
$_SG['senha'] = 'blue.indico16'; //senha MySQL
$_SG['db'] = 'blueindico_blog'; //Banco de dados MySQL

$_SG['paginaLogin'] = 'http://blueindico.com.br/postagem/'; //pagina de login

$_SG['tabela'] = 'usuario'; //nome da tabela onde os usuarios sao salvos
//=========================================================================================================

//=========================================================================================================
//campos fixos
//=========================================================================================================

//verifica coneção com o servidor
if ($_SG['conectaServidor'] == true){
	//$_SG['link'] = mysql_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha']) or 
	//	die ("MySQL: Não foi possivel conectar-se ao servidor [". $_SG['servidor']."].");
	//mysql_select_db($_SG['db'], $_SG['link']) or die ("Mysql: nao foi possivel comectar-se ao banco de dados");
    $_SG['link'] = new PDO ('mysql:host=blueindico-blog.mysql.uhserver.com;dbname=blueindico_blog;','user_blog','blue.indico16');
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
        $sql = "SELECT * 
					FROM ".$_SG['tabela']." 
					WHERE user = '".$nusuario."' AND pwd = '".$nsenha."'";
        $query = $_SG['link'] -> query($sql);
        $resultado = $query -> fetch(PDO::FETCH_ASSOC);

        //verifica se encontrou algum registro
        if(empty($resultado)){
            //Nenhum registro foi encontrado => o usuario é invalido
            return false;
        }else{
            //definimos dois valores na sessao com os dados do usuario
            $_SESSION['usuarioID'] = $resultado['id']; //Pega o valor da coluna 'id' do registro encontrado no MySQL
            $_SESSION['usuarioNomeadm'] = $resultado['nm'];//Pega o valor da coluna 'nm_franq' do registro encontrado no MySQL
			//$_SESSION['id_franq'] = $resultado['id_franq'];//pega o valor da coluna 'id_franq do registro encontrado no MySQL

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
        if(!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNomeadm'])){
            //nao ha usuario logado, muda para pagina de login
            expulsaVisitante();
        }else if(!isset ($_SESSION['usuarioID']) OR !isset ($_SESSION['usuarioNomeadm'])){
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
        unset($_SESSION['usuarioID'], $_SESSION['usuarioNomeadm'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);
        
        //manda para a tela de login
        header('Location:'.$_SG['paginaLogin']);
    }
?>