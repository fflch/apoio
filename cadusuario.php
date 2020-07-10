<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');
require_once ('includes/PasswordHash.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$usuariohelper = new UsuarioHelper();
	operacao($usuariohelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(UsuarioHelper $usuariohelper, DAOBanco $banco) {
	$codigo = 0;
	$operacao = "";
	if (isset($_GET['operacao'])) {
		$operacao = $_GET['operacao'];
	}
	else if (isset($_POST['operacao'])) {
		$operacao = $_POST['operacao'];
	}
	if (isset($_GET['codigo'])) {
		$codigo = $_GET['codigo'];
	}
	else if (isset($_POST['codigo'])) {
		$codigo = $_POST['codigo'];
	}
	$salvar = isset($_POST['salvar']) ? $_POST['salvar'] : null;
	date_default_timezone_set("America/Sao_Paulo");
	$resultados = array();
	$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $codigo));
	if (strcasecmp($operacao, Constantes::EDITAR) == 0 && !is_null($salvar)) {
		try {
			if ($usuariohelper->validarLoginSenha($banco, $_POST['edtlogin'], $codigo)) {
				$mensagem = "Login j&aacute; cadastrado, favor alterar!";
				mostraTemplate($banco, array() , $mensagem, $codigo, $operacao);
			}
		  else {
    		try {
			    $camposValores = populaCampos();
			    $usuariohelper->alterar($banco, $camposValores, $filtro);
			    $mensagem = "Registro: " . $codigo . " alterado com sucesso";
		    }
		    catch (Exception $e) {
			    $mensagem = "N&atilde;o foi poss&iacute;vel alterar o registro: " . $codigo . ". Erro: " . $e->getMessage();
		    }
		    try {
			    $resultados = $usuariohelper->consultar($banco, null, $filtro);
		    }
		    catch (Exception $e) {
			    $mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro alterado" . ". Erro: " . $e->getMessage();
		    }
		    mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao);
	    }
	  }
	  catch (Exception $e) {
			mostraTemplate($banco, array() , $e->getMessage() , $codigo, $operacao);
		}
	}
	else if (strcasecmp($operacao, Constantes::INSERIR) == 0 && !is_null($salvar)) {
		try {
			if ($usuariohelper->validarLoginSenha($banco, $_POST['edtlogin'])) {
				$mensagem = "Login j&aacute; cadastrado, favor alterar!";
				mostraTemplate($banco, array() , $mensagem, $codigo, $operacao);
			}
		  else {
		    try {
			    $camposValores = populaCampos();
			    $usuariohelper->incluir($banco, $camposValores);
			    $mensagem = "Registro inclu&iacute;do com sucesso";
		    }
		    catch (Exception $e) {
			    $mensagem = "N&atilde;o foi poss&iacute;vel incluir o registro" . ". Erro: " . $e->getMessage();
		    }
		    mostraTemplate($banco, array() , $mensagem, $codigo, $operacao);
	    }
	  }
		catch (Exception $e) {
			mostraTemplate($banco, array() , $e->getMessage() , $codigo, $operacao);
		}
	}
	else if (strcasecmp($operacao, Constantes::EDITAR) == 0) {
		try {
			$mensagem = null;
			$resultados = $usuariohelper->consultar($banco, null, $filtro);
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro" . ". Erro: " . $e->getMessage();
		}
		mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao);
	}
	else if (strcasecmp($operacao, Constantes::INSERIR) == 0) {
		mostraTemplate($banco, $resultados, null, $codigo, $operacao);
	}
}

function populaCampos() {
	$camposValores = array();
	$camposValores['nome'] = isset($_POST['edtnome']) ? $_POST['edtnome'] : $_GET['edtnome'];
	$camposValores['login'] = isset($_POST['edtlogin']) ? $_POST['edtlogin'] : $_GET['edtlogin'];
  $password = trim(isset($_POST['edtsenha']) ? $_POST['edtsenha'] : $_GET['edtsenha']);
  if (strlen($password) > 0) {
	  $camposValores['senha'] = gerarhash($password); 
	}
	$camposValores['nivel'] = isset($_POST['lstnivel']) ? $_POST['lstnivel'] : $_GET['lstnivel'];
	$camposValores['status'] = isset($_POST['lststatus']) ? $_POST['lststatus'] : $_GET['lststatus'];
	if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
   	$userlogado = $_SESSION[Constantes::OBJETO_USUARIO];
	}
	$camposValores['idusuario'] = isset($userlogado) ? $userlogado->getID() : null;
	return $camposValores;
}

function gerarhash($password) {  
  if (strlen($password) > 72 ) {
    exit("Ocorreu o seguinte erro: Senha fornecida &eacute; muito longa!");
  }
  else { 
    $hasher = new PasswordHash(8, FALSE);
    $hash = $hasher->HashPassword($password);
	  if (strlen($hash) < 20) {
      exit("Ocorreu o seguinte erro: Falha ao gerar o hash da senha!"); 
	  }
	  else {
	    return $hash;
	  }
 	  unset($hasher);
  }	   
}


function mostraTemplate(DAOBanco $banco, $resultados, $mensagem = null, $codigo = null, $operacao = null) {
	$nome = "";
	$login = "";
	$senha = "";
	$nivel = "";
	$status = "";
	$requerido = "";
	$opcoesstatus = array("",Usuario::STATUS_ATIVO,Usuario::STATUS_INATIVO);
	$opcoesstatusnome = array("Selecione o Status ","Ativo","Inativo");
	$opcoesnivel = array("",Usuario::NIVEL_ADMINISTRADOR,Usuario::NIVEL_USUARIO);
	$opcoesniveldescricao = array("Selecione o N&iacute;vel","Administrador","Usuario");
	if (count($resultados) > 0) {
		foreach ($resultados as $usuario) {
			$nome      = $usuario->getNome();
			$login     = $usuario->getLogin();
			$senha 	   = null;
			$nivel     = $usuario->getNivel();
			$status    = $usuario->getStatus();
		}
	}
	if ( strcasecmp($operacao, Constantes::INSERIR) == 0) {
	 $requerido = "requerido";
	}
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("nome", $nome);
	$smarty->assign("login", $login);
	$smarty->assign("senha", $senha);
	$smarty->assign("opcoesnivel", $opcoesnivel);
	$smarty->assign("opcoesniveldescricao", $opcoesniveldescricao);
	$smarty->assign("opcoesnivelpad", $nivel);
	$smarty->assign("status", $status);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("opcoesstatus", $opcoesstatus);
	$smarty->assign("opcoesstatusnome", $opcoesstatusnome);
	$smarty->assign("opcoesstatuspad", $status);
	$smarty->assign("operacao", $operacao);
	$smarty->assign("requerido", $requerido);
	$smarty->display("cadusuario.tpl");
}
?>
