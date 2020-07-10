<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$cargohelper = new CargoHelper();
	operacao($cargohelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(CargoHelper $cargohelper, DAOBanco $banco) {
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
			$cargohelper->excluir($banco, $filtro);
			$mensagem = "Registro: " . $codigo . " exclu&iacute;do com sucesso.";
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel excluir o registro: " . $codigo . ". Erro: " . $e->getMessage();
		}
		mostraTemplate($cargohelper, $banco, $mensagem);
	}
	else if (strcasecmp($operacao, Constantes::CONSULTAR) == 0) {
		 $campo =  isset($_GET['lstcampo']) ? $_GET['lstcampo'] : null;
		 $campovalor = isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null;
		 if (strcasecmp($campo, "cargo") == 0) {
			 $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_CONTEM, array("cargo" => "%$campovalor%"));
			 $resultados = array();
			 try {
				 $resultados = $cargohelper->consultar($banco, null, $filtro);
		   }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar o departamento " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($cargohelper, $banco, $mensagem = null, $resultados);
		 }
     else {
			  $resultados = array();
			  try {
				  $resultados = $cargohelper->consultar($banco, null);
			  }
			  catch (Exception $e) {
			  	$mensagem = "N&atilde;o foi poss&iacute;vel consultar o departamento " . ". Erro: " . $e->getMessage();
			  }
			  mostraTemplate($cargohelper, $banco, $mensagem = null, $resultados);
		 }
	 }
	 else {
		 mostraTemplate($cargohelper, $banco);
	 }
}

function mostraTemplate(CargoHelper $cargohelper, DAOBanco $banco, $mensagem = null, $resultados = null) {
	$codigo    = array();
	$cargo     = array();
	$links_excluir = array();
	$links_editar = array();
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$link_consultar = "admcargo.php?operacao=" . Constantes::CONSULTAR ."&";
	if (is_null($resultados)) {
		try {
			$resultados = $cargohelper->consultar($banco, null, null, array('CARGO'));
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel consultar registros de departamentos" . ". Erro: " . $e->getMessage();
		}
	}
	foreach ($resultados as $cargos) {
		$codigo[] = $cargos->getId();
		$cargo[]  = $cargos->getCargo();
		$links_editar[] = "cadcargo.php?operacao=" . Constantes::EDITAR . "&" . "codigo=" . $cargos->getId();
		$links_excluir[] = $_SERVER['PHP_SELF'] . "?operacao=" . Constantes::EXCLUIR . "&" . "codigo=" . $cargos->getId();
	}
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("cargo", $cargo);
	$smarty->assign("links_editar", $links_editar);
	$smarty->assign("links_excluir", $links_excluir);
	$smarty->assign("link_consultar", $link_consultar);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->display("admcargo.tpl");
}
?>
