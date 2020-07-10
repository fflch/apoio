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
	    $camposValores = populaCampos();
	    $areahelper->alterar($banco, $camposValores, $filtro);
	    $mensagem = "Registro: " . $codigo . " alterado com sucesso";
    }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel alterar o registro: " . $codigo . ". Erro: " . $e->getMessage();
	  }
	  try {
	    $resultados = $areahelper->consultar($banco, null, $filtro);
	  }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro alterado" . ". Erro: " . $e->getMessage();
	  }
	  mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao);
  }
	else if (strcasecmp($operacao, Constantes::INSERIR) == 0 && !is_null($salvar)) {
    try {
	    $camposValores = populaCampos();
	    $areahelper->incluir($banco, $camposValores);
	    $mensagem = "Registro inclu&iacute;do com sucesso";
    }
    catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel incluir o registro" . ". Erro: " . $e->getMessage();
	  }
	  mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao);
	}
	else if (strcasecmp($operacao, Constantes::EDITAR) == 0) {
   	try {
			$mensagem = null;
			$resultados = $areahelper->consultar($banco, null, $filtro);
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
	$camposValores['iddepto'] = isset($_POST['lstidepto']) ? $_POST['lstidepto'] : $_GET['lstidepto'];
	$camposValores['area'] = isset($_POST['edtarea']) ? $_POST['edtarea'] : $_GET['edtarea'];
	if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
   	$userlogado = $_SESSION[Constantes::OBJETO_USUARIO];
	}
	$camposValores['idusuario'] = isset($userlogado) ? $userlogado->getID() : null;
	return $camposValores;
}

function mostraTemplate(DAOBanco $banco, $resultados, $mensagem = null, $codigo = null, $operacao = null) {
	$idepto = "";
	$area = "";
	if (count($resultados) > 0) {
		foreach ($resultados as $areas) {
			$idepto = $areas->getIDDepto();
			$area   = $areas->getArea();
		}
	}
  $departamentos = array();
  $deptos_id = array();
  $sigla = array();
  try {
    $deptohelper = new DeptoHelper();
    $departamentos = $deptohelper->consultar($banco,null);
  }
  catch(Exception $e){
    $mensagem = "N&atilde;o foi poss&iacute;vel consultar os departamentos" . ". Erro: " . $e->getMessage();
  }
  if (count($departamentos) > 0 ) {
    $deptos_id[] = "";
    $sigla[] = "Selecione o Depto.";
    foreach($departamentos as $deptos) {
      $deptos_id[] = $deptos->getID();
      $sigla[] = $deptos->getSigla();
    }
  }
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("area", $area);
	$smarty->assign("opcoesdeptos_id", $deptos_id);
	$smarty->assign("opcoesigla", $sigla);
	$smarty->assign("opcoesdeptopad", $idepto);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("operacao", $operacao);
	$smarty->display("cadarea.tpl");
}
?>
