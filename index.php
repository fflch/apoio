<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');
require_once ('includes/PasswordHash.inc.php');
if (!isset($_SESSION)) {
  session_start();
}

if (isset($_POST['edtlogin'])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$login = $_POST['edtlogin'];
	$senha = $_POST['edtsenha'];
	$mensagem = "";
	$usuariohelper = new UsuarioHelper();
	$resultado = array();
	$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("login" => $login));
	try {
		$resultado = $usuariohelper->consultar($banco, null, $filtro);
	}
	catch (Exception $e) {
		$mensagem = "Erro ao consultar usu&aacute;rio. Erro: " . $e->getMessage();
	}
	if (count($resultado) > 0) {
		foreach ($resultado as $usuario) {
		  if ($usuario->getStatus() === "I") {
		    $mensagem = "Usu&aacute;rio Inativo";
		  }
		  else {
		    $hash = $usuario->getSenha();
		    $hasher = new passwordhash(8, FALSE); 
		    $check = $hasher->CheckPassword($senha, $hash);
		    if ($check) {
  			  $_SESSION[Constantes::OBJETO_USUARIO] = $usuario;
       		header("location:logado.php");		      
		    }
		    else{
      		$mensagem = "Senha inv&aacute;lidos";
		    }
		    unset($hasher); 
		  }
     	mostraTemplate($mensagem, $login, $senha);		    		  
		}
	}
	else {
		$mensagem = "Usu&aacute;rio ou Senha inv&aacute;lidos";
		mostraTemplate($mensagem, $login, $senha);
	}
}
else {
	mostraTemplate("", "", "");
}

function mostraTemplate($mensagem, $login, $senha) {
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("login", $login);
	$smarty->assign("senha", $senha);
	$smarty->display("index.tpl");
}
?>
