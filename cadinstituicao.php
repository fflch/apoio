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
	    $instituicaohelper->alterar($banco, $camposValores, $filtro);
	    $mensagem = "Registro: " . $codigo . " alterado com sucesso";
    }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel alterar o registro: " . $codigo . ". Erro: " . $e->getMessage();
	  }
	  try {
	    $resultados = $instituicaohelper->consultar($banco, null, $filtro);
	  }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro alterado" . ". Erro: " . $e->getMessage();
	  }
	  mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao);
  }
	else if (strcasecmp($operacao, Constantes::INSERIR) == 0 && !is_null($salvar)) {
    try {
	    $camposValores = populaCampos();
	    $instituicaohelper->incluir($banco, $camposValores);
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
			$resultados = $instituicaohelper->consultar($banco, null, $filtro);
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
	$camposValores['sigla'] = isset($_POST['edtsigla']) ? $_POST['edtsigla'] : $_GET['edtsigla'];
	$camposValores['instituicao'] = isset($_POST['edtinstituicao']) ? $_POST['edtinstituicao'] : $_GET['edtinstituicao'];
	$camposValores['unidade'] = isset($_POST['edtunidade']) ? $_POST['edtunidade'] : $_GET['edtunidade'];
	$camposValores['local'] = isset($_POST['edtlocal']) ? $_POST['edtlocal'] : $_GET['edtlocal'];
	if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
   	$userlogado = $_SESSION[Constantes::OBJETO_USUARIO];
	}
	$camposValores['idusuario'] = isset($userlogado) ? $userlogado->getID() : null;
	return $camposValores;
}

function mostraTemplate(DAOBanco $banco, $resultados, $mensagem = null, $codigo = null, $operacao = null) {
	$sigla  = "";
	$instituicao = "";
	$unidade = "";
	$local = "";
	if (count($resultados) > 0) {
		foreach ($resultados as $instituicoes) {
			$sigla = $instituicoes->getSigla();
			$instituicao = $instituicoes->getInstituicao();
			$unidade = $instituicoes->getUnidade();
			$local = $instituicoes->getLocal();
		}
	}
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("sigla", $sigla);
	$smarty->assign("instituicao", $instituicao);
	$smarty->assign("unidade", $unidade);
	$smarty->assign("local", $local);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("operacao", $operacao);
	$smarty->display("cadinstituicao.tpl");
}
?>
