<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');
ini_set('ibase.dateformat','%d/%m/%Y');
if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$cedulahelper = new CedulaHelper();
	operacao($cedulahelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(CedulaHelper $cedulahelper, DAOBanco $banco) {
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
			$cedulahelper->excluir($banco, $filtro);
			$mensagem = "Registro: " . $codigo . " exclu&iacute;do com sucesso.";
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel excluir o registro: " . $codigo . ". Erro: " . $e->getMessage();
		}
		mostraTemplate($cedulahelper, $banco, $mensagem);
	}
	else if (strcasecmp($operacao, Constantes::CONSULTAR) == 0) {
		 $campovalor = str_replace("/",".", isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null);
		 $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("data" => $campovalor));
		 $filtro->adicionaCampoFiltro("votacao", "N");
	   $resultados = array();
		   try {
				 $resultados = $cedulahelper->consultar($banco, array("id","tipo","item","data","pertence","pauta"), $filtro, array('item'));
			 }
			 catch (Exception $e) {
			   $mensagem = "N&atilde;o foi poss&iacute;vel consultar a c&eacute;dula " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($cedulahelper, $banco, $mensagem = null, $resultados);
	 }
	 else {
		 mostraTemplate($cedulahelper, $banco);
	 }
}

function mostraTemplate(CedulaHelper $cedulahelper, DAOBanco $banco, $mensagem = null, $resultados = null) {
  $codigo   = array();
  $item     = array();
  $pauta    = array();
  $data     = array();
  $pertence = array();
  $links_excluir = array();
  $links_editar = array();
  $links_visualizar = array();
  $cor_linha = array('#f5f6fc','#FFFFFF');
  $link_consultar = "admcedula.php?operacao=" . Constantes::CONSULTAR ."&";
  if (is_null($resultados)) {
    $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("votacao" => "N"));
      try {
        $resultados = $cedulahelper->consultar($banco, array("id","tipo","item","data","pertence","pauta"), $filtro, array('item'));
      }
      catch (Exception $e) {
	$mensagem = "N&atilde;o foi poss&iacute;vel consultar registros de c&eacute;dulas" . ". Erro: " . $e->getMessage();
      }
   }
   foreach ($resultados as $cedulas) {
     $codigo[] = $cedulas->getId();
     $item[]  = $cedulas->getItem();
     $pauta[] = $cedulas->getPauta();
     $data[] = $cedulas->getData();
     if ($cedulas->getPertence() == "con" ) {
       $pertence[] = "Congrega&ccedil;&atilde;o";
     }
     else {
       $pertence[] = "CTA";
     }
     $links_visualizar[] = "codigo=" . $cedulas->getID() . "&tipo=" . $cedulas->getTipo();
		$links_editar[] = "cadcedula.php?operacao=" . Constantes::EDITAR . "&" . "codigo=" . $cedulas->getID();
		$links_excluir[] = $_SERVER['PHP_SELF'] . "?operacao=" . Constantes::EXCLUIR . "&" . "codigo=" . $cedulas->getID();
	}
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("item", $item);
	$smarty->assign("pertence", $pertence);
	$smarty->assign("pauta", $pauta);
	$smarty->assign("data", $data);
	$smarty->assign("links_editar", $links_editar);
	$smarty->assign("links_excluir", $links_excluir);
	$smarty->assign("link_consultar", $link_consultar);
	$smarty->assign("links_visualizar", $links_visualizar);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->display("admcedula.tpl");
}
?>
