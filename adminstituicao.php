<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$instituicaohelper = new InstituicaoHelper();
	operacao($instituicaohelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(InstituicaoHelper $instituicaohelper, DAOBanco $banco) {
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
			$instituicaohelper->excluir($banco, $filtro);
			$mensagem = "Registro: " . $codigo . " exclu&iacute;do com sucesso.";
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel excluir o registro: " . $codigo . ". Erro: " . $e->getMessage();
		}
		mostraTemplate($instituicaohelper, $banco, $mensagem);
	}
	else if (strcasecmp($operacao, Constantes::CONSULTAR) == 0) {
		 $campo =  isset($_GET['lstcampo']) ? $_GET['lstcampo'] : null;
		 $campovalor = isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null;
		 if (strcasecmp($campo, "sigla") == 0) {
			 $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_CONTEM, array("sigla" => urlencode("%$campovalor%")));
			 $resultados = array();
			 try {
				 $resultados = $instituicaohelper->consultar($banco, null, $filtro);
		   }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar o departamento " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($instituicaohelper, $banco, $mensagem = null, $resultados);
		 }
		 else if (strcasecmp($campo, "instituicao") == 0) {
			 $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_CONTEM, array("instituicao" => urlencode("%$campovalor%")));
			 $resultados = array();
			 try {
			 	 $resultados = $instituicaohelper->consultar($banco, null, $filtro);
			 }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar o departamento " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($instituicaohelper, $banco, $mensagem = null, $resultados);
		  }
      else {
			  $resultados = array();
			  try {
				  $resultados = $instituicaohelper->consultar($banco, null);
			  }
			  catch (Exception $e) {
			  	$mensagem = "N&atilde;o foi poss&iacute;vel consultar o departamento " . ". Erro: " . $e->getMessage();
			  }
			  mostraTemplate($instituicaohelper, $banco, $mensagem = null, $resultados);
		  }
	 }
	 else {
		 mostraTemplate($instituicaohelper, $banco);
	 }
}

function mostraTemplate(instituicaohelper $instituicaohelper, DAOBanco $banco, $mensagem = null, $resultados = null) {
	$codigo    = array();
	$sigla     = array();
	$instituicao = array();
	$links_excluir = array();
	$links_editar = array();
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$link_consultar = "adminstituicao.php?operacao=" . Constantes::CONSULTAR ."&";
  $opcoesidcampo = array("sigla","instituicao");
	$opcoescampo = array("Sigla","Institui&ccedil;&atilde;o");
	$opcoescampopad = isset($_GET['lstcampo']) ? $_GET['lstcampo'] : null;
	$campovalor = utf8_decode(isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null);
	if (is_null($resultados)) {
		try {
			$resultados = $instituicaohelper->consultar($banco, null, null, array('SIGLA'));
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel consultar registros de departamentos" . ". Erro: " . $e->getMessage();
		}
	}
	foreach ($resultados as $instituicoes) {
		$codigo[] = $instituicoes->getId();
		$sigla[] = $instituicoes->getSigla();
		$instituicao[] = $instituicoes->getInstituicao();
		$links_editar[] = "cadinstituicao.php?operacao=" . Constantes::EDITAR . "&" . "codigo=" . $instituicoes->getId();
		$links_excluir[] = $_SERVER['PHP_SELF'] . "?operacao=" . Constantes::EXCLUIR . "&" . "codigo=" . $instituicoes->getId();
	}
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("sigla", $sigla);
	$smarty->assign("instituicao", $instituicao);
	$smarty->assign("opcoesidcampo", $opcoesidcampo);
	$smarty->assign("opcoescampo", $opcoescampo);
	$smarty->assign("opcoescampopad", $opcoescampopad);
	$smarty->assign("campovalor", $campovalor);
	$smarty->assign("links_editar", $links_editar);
	$smarty->assign("links_excluir", $links_excluir);
	$smarty->assign("link_consultar", $link_consultar);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->display("adminstituicao.tpl");
}
?>
