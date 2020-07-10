<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');
ini_set('ibase.dateformat','%d/%m/%Y');
if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$concursohelper = new ConcursoHelper();
	operacao($concursohelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(ConcursoHelper $concursohelper, DAOBanco $banco) {
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
	if (strcasecmp($operacao, Constantes::CONSULTAR) == 0) {
		$dataincio = str_replace("/",".", isset($_GET['datainicio']) ? $_GET['datainicio'] : $_POST['datainicio']);
		$datafim   = str_replace("/",".", isset($_GET['datafim']) ? $_GET['datafim']  : $_POST['datafim']);
		$status    = isset($_GET['lststatus']) ? $_GET['lststatus'] : $_POST['lststatus'];
	  $resultados = array();
		try {
		  $sql = "SELECT ID, DESCRICAO FROM CONCURSOS WHERE STATUS = '$status' AND INICIOPROVA BETWEEN '$dataincio' AND '$datafim';";
		  $resultados = $concursohelper->consultar($banco, null, null, null, $sql);
		}
		catch (Exception $e) {
		  $mensagem = "N&atilde;o foi poss&iacute;vel consultar os concursos" . ". Erro: " . $e->getMessage();
	  }
	  mostraTemplate($concursohelper, $banco, $mensagem = null, $resultados);
	}
	else {
		$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("status" => 'C'));
		try {
			$resultados = $concursohelper->consultar($banco, array('ID','DESCRICAO'), $filtro);
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel consultar os concursos em certame: " . $codigo . ". Erro: " . $e->getMessage();
		}
		mostraTemplate($concursohelper, $banco, $mensagem = null, $resultados);
	}
}

function mostraTemplate(ConcursoHelper $concursoHelper, DAOBanco $banco, $mensagem = null, $resultados = null) {
	$codigo    = array();
	$descricao = array();
	$links_editar = array();
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$link_consultar = "admresultado.php?operacao=" . Constantes::CONSULTAR ."&";
	$dataincio = isset($_GET['datainicio']) ? $_GET['datainicio'] : null;
  $datafim   = isset($_GET['datafim']) ? $_GET['datafim']  : null;
  $opcoesidstatus = array("C","F");
  $opcoestatus = array("Certame","Finalizado");
	$opcoestatuspad =  isset($_GET['lststatus']) ? $_GET['lststatus'] : null;
	$total = count($resultados);
	if (count($resultados) > 0) {
  	foreach ($resultados as $concurso) {
	  	$codigo[] = $concurso->getID();
		  $descricao[]  = $concurso->getDescricao();
		  $links_editar[] = "cadresultado.php?operacao=" . Constantes::EDITAR . "&" . "codigo=" . $concurso->getID();
	  }
	}
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("descricao", $descricao);
	$smarty->assign("datainicio", $dataincio);
	$smarty->assign("datafim", $datafim);
	$smarty->assign("opcoesidstatus", $opcoesidstatus);
	$smarty->assign("opcoestatus", $opcoestatus);
	$smarty->assign("opcoestatuspad", $opcoestatuspad);
	$smarty->assign("total", $total);
	$smarty->assign("links_editar", $links_editar);
	$smarty->assign("link_consultar", $link_consultar);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->display("admresultado.tpl");
}
?>
