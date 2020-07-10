<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$usuariohelper = new UsuarioHelper();
	operacao($usuariohelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(UsuarioHelper $usuariohelper, DAOBanco $banco) {
	$operacao = "";
	$codigo = 0;
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
	if (strcasecmp($operacao, Constantes::EXCLUIR) == 0) {
		$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $codigo));
		try {
			$usuariohelper->excluir($banco, $filtro);
			$mensagem = "Registro: " . $codigo . " exclu&iacute;do com sucesso.";
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel excluir o registro: " . $codigo . ". Erro: " . $e->getMessage();
		}
		mostraTemplate($usuariohelper, $banco, $mensagem);
	}
	else if (strcasecmp($operacao, Constantes::CONSULTAR) == 0) {
		 $campo =  isset($_GET['lstcampo']) ? $_GET['lstcampo'] : null;
		 $campovalor = isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null;
		 if (strcasecmp($campo, "id") == 0) {
			 $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $campovalor));
			 $resultados = array();
			 try {
				 $resultados = $usuariohelper->consultar($banco, null, $filtro);
		   }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar o usuario " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($usuariohelper, $banco, $mensagem = null, $resultados);
		 }
		 else if (strcasecmp($campo, "Nome") == 0) {
			 $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_CONTEM, array("Nome" => "%$campovalor%"));
			 $resultados = array();
			 try {
			 	 $resultados = $usuariohelper->consultar($banco, null, $filtro);
			 }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar usuario " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($usuariohelper, $banco, $mensagem = null, $resultados);
		  }
      else {
			  $resultados = array();
			  try {
				  $resultados = $usuariohelper->consultar($banco, null);
			  }
			  catch (Exception $e) {
			  	$mensagem = "N&atilde;o foi poss&iacute;vel consultar o usuario " . ". Erro: " . $e->getMessage();
			  }
			  mostraTemplate($usuariohelper, $banco, $mensagem = null, $resultados);
		  }
	 }
	 else {
		 mostraTemplate($usuariohelper, $banco);
	 }
}

function mostraTemplate(UsuarioHelper $usuariohelper, DAOBanco $banco, $mensagem = null, $resultados = null) {
	$codigo    = array();
	$login     = array();
	$senha     = array();
	$nome      = array();
	$status    = array();
	$nivel     = array();
	$links_excluir = array();
	$links_editar = array();
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$link_consultar = "admusuario.php?operacao=" . Constantes::CONSULTAR ."&";
	if (is_null($resultados)) {
		try {
			$resultados = $usuariohelper->consultar($banco, null, null, array('NOME'));
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel consultar registros de usuarios" . ". Erro: " . $e->getMessage();
		}
	}
	foreach ($resultados as $usuario) {
	  if ( $usuario->getLogin() <> "admin") {
		  $codigo[] = $usuario->getId();
		  $login[]  = $usuario->getLogin();
		  $senha[]  = $usuario->getSenha();
		  $nome[]   = $usuario->getNome();
		  $status[] = $usuario->getStatus();
		  $nivel[]  = $usuario->getNivel();
		  $links_editar[] = "cadusuario.php?operacao=" . Constantes::EDITAR . "&" . "codigo=" . $usuario->getId();
		  $links_excluir[] = $_SERVER['PHP_SELF'] . "?operacao=" . Constantes::EXCLUIR . "&" . "codigo=" . $usuario->getId();
		}
	}
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("nome", $nome);
	$smarty->assign("login", $login);
  $smarty->assign("senha", $senha);
  $smarty->assign("status", $status);
	$smarty->assign("nivel", $nivel);
	$smarty->assign("links_editar", $links_editar);
	$smarty->assign("links_excluir", $links_excluir);
	$smarty->assign("link_consultar", $link_consultar);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->display("admusuario.tpl");
}
?>
