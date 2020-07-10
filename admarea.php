<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$areahelper = new AreaHelper();
	operacao($areahelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(AreaHelper $areahelper, DAOBanco $banco) {
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
			$areahelper->excluir($banco, $filtro);
			$mensagem = "Registro: " . $codigo . " exclu&iacute;do com sucesso.";
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel excluir o registro: " . $codigo . ". Erro: " . $e->getMessage();
		}
		mostraTemplate($areahelper, $banco, $mensagem);
	}
	else if (strcasecmp($operacao, Constantes::CONSULTAR) == 0) {
		 $campo =  isset($_GET['lstdepto']) ? $_GET['lstdepto'] : null;
		 if (!is_null($campo)) {
			 $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("iddepto" => $campo));
			 $resultados = array();
			 try {
				 $resultados = $areahelper->consultar($banco, null, $filtro, array('area'));
		   }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar o departamento " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($areahelper, $banco, $mensagem = null, $resultados);
		 }
     else {
			  $resultados = array();
			  try {
				  $resultados = $areahelper->consultar($banco, null);
			  }
			  catch (Exception $e) {
			  	$mensagem = "N&atilde;o foi poss&iacute;vel consultar o departamento " . ". Erro: " . $e->getMessage();
			  }
			  mostraTemplate($areahelper, $banco, $mensagem = null, $resultados);
		 }
	 }
	 else {
		 mostraTemplate($areahelper, $banco);
	 }
}

function mostraTemplate(AreaHelper $areahelper, DAOBanco $banco, $mensagem = null, $resultados = null) {
	$codigo = array();
	$depto  = array();
	$area   = array();
	$links_excluir = array();
	$links_editar = array();
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$link_consultar = "admarea.php?operacao=" . Constantes::CONSULTAR ."&";
	$departamentos = array();
  $idepto = array();
  $sigla = array();
  $campo =  isset($_GET['lstdepto']) ? $_GET['lstdepto'] : null;
  try {
    $deptohelper = new DeptoHelper();
    $departamentos = $deptohelper->consultar($banco,null, null, array('sigla'));
  }
  catch(Exception $e){
    $mensagem = "N&atilde;o foi poss&iacute;vel consultar os departamentos" . ". Erro: " . $e->getMessage();
  }
  $idepto[] = "0";
  $sigla[] = "Selecione o Depto.";
  if (count($departamentos) > 0 ) {
    foreach($departamentos as $deptos) {
      $idepto[] = $deptos->getID();
      $sigla[] = $deptos->getSigla();
    }
  }
  if (count($resultados) > 0) {
  	foreach ($resultados as $areas) {
		  $codigo[] = $areas->getId();
		  $area[]  = $areas->getArea();
		  $links_editar[] = "cadarea.php?operacao=" . Constantes::EDITAR . "&" . "codigo=" . $areas->getId();
		  $links_excluir[] = $_SERVER['PHP_SELF'] . "?operacao=" . Constantes::EXCLUIR . "&" . "codigo=" . $areas->getId();
	  }
  }

	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("area", $area);
	$smarty->assign("opcoesidepto", $idepto);
	$smarty->assign("opcoesigla", $sigla);
	$smarty->assign("opcoesdeptopad", $campo);
	$smarty->assign("links_editar", $links_editar);
	$smarty->assign("links_excluir", $links_excluir);
	$smarty->assign("link_consultar", $link_consultar);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->display("admarea.tpl");
}
?>
