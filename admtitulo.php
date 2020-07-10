<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$titulohelper = new TituloHelper();
	operacao($titulohelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(TituloHelper $titulohelper, DAOBanco $banco) {
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
			$titulohelper->excluir($banco, $filtro);
			$mensagem = "Registro: " . $codigo . " exclu&iacute;do com sucesso.";
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel excluir o registro: " . $codigo . ". Erro: " . $e->getMessage();
		}
		mostraTemplate($titulohelper, $banco, $mensagem);
	}
	else if (strcasecmp($operacao, Constantes::CONSULTAR) == 0) {
		 $campo =  isset($_GET['lstcampo']) ? $_GET['lstcampo'] : null;
		 $campovalor = isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null;
		 if (strcasecmp($campo, "titulo") == 0) {
			 $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_CONTEM, array("titulo" => "%$campovalor%"));
			 $resultados = array();
			 try {
				 $resultados = $titulohelper->consultar($banco, null, $filtro);
		   }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar o departamento " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($titulohelper, $banco, $mensagem = null, $resultados);
		 }
     else {
			  $resultados = array();
			  try {
				  $resultados = $titulohelper->consultar($banco, null);
			  }
			  catch (Exception $e) {
			  	$mensagem = "N&atilde;o foi poss&iacute;vel consultar o departamento " . ". Erro: " . $e->getMessage();
			  }
			  mostraTemplate($titulohelper, $banco, $mensagem = null, $resultados);
		 }
	 }
	 else {
		 mostraTemplate($titulohelper, $banco);
	 }
}

function mostraTemplate(TituloHelper $titulohelper, DAOBanco $banco, $mensagem = null, $resultados = null) {
	$codigo    = array();
	$titulo     = array();
	$links_excluir = array();
	$links_editar = array();
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$link_consultar = "admtitulo.php?operacao=" . Constantes::CONSULTAR ."&";
	if (is_null($resultados)) {
		try {
			$resultados = $titulohelper->consultar($banco, null, null, array('TITULO'));
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel consultar registros de departamentos" . ". Erro: " . $e->getMessage();
		}
	}
	foreach ($resultados as $titulos) {
		$codigo[] = $titulos->getId();
		$titulo[]  = $titulos->getTitulo();
		$links_editar[] = "cadtitulo.php?operacao=" . Constantes::EDITAR . "&" . "codigo=" . $titulos->getId();
		$links_excluir[] = $_SERVER['PHP_SELF'] . "?operacao=" . Constantes::EXCLUIR . "&" . "codigo=" . $titulos->getId();
	}
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("titulo", $titulo);
	$smarty->assign("links_editar", $links_editar);
	$smarty->assign("links_excluir", $links_excluir);
	$smarty->assign("link_consultar", $link_consultar);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->display("admtitulo.tpl");
}
?>
