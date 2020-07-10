<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');
ini_set('ibase.dateformat','%d/%m/%Y');
if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$suplentehelper = new SuplenteHelper();
	operacao($suplentehelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(SuplenteHelper $suplentehelper, DAOBanco $banco) {
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
	    $suplentehelper->alterar($banco, $camposValores, $filtro);
	    $mensagem = "Registro: " . $codigo . " alterado com sucesso";
    }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel alterar o registro: " . $codigo . ". Erro: " . $e->getMessage();
	  }
	  try {
 	    $sql = "SELECT CS.IDPESSOA, P.NOME AS SUPLENTE, CS.IDCOMPOSICAOTITULAR, CS.IDDEPARTAMENTO, CS.PERTENCE,
              CS.INICIO, CS.TERMINO, CS.OBSERVACAO, CS.ATIVO, T.NOME AS TITULAR, C.CARGO
              FROM COMPOSICOESSUPLENTES CS INNER JOIN PESSOAS P
              ON(CS.IDPESSOA = P.ID) INNER JOIN COMPOSICOESTITULARES CT
              ON(CS.IDCOMPOSICAOTITULAR = CT.ID) INNER JOIN PESSOAS T
              ON(CT.IDPESSOA = T.ID) INNER JOIN CARGOS C
              ON(CT.IDCARGO = C.ID)
              WHERE CS.ID = $codigo AND CS.ATIVO = 'A'";
	    $resultados = $suplentehelper->consultar($banco, null, null, null, $sql);
	  }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro alterado" . ". Erro: " . $e->getMessage();
	  }
	  mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao);
  }
	else if (strcasecmp($operacao, Constantes::INSERIR) == 0 && !is_null($salvar)) {
    try {
	    $camposValores = populaCampos();
	    $suplentehelper->incluir($banco, $camposValores);
	    $mensagem = "Registro inclu&iacute;do com sucesso";
    }
    catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel incluir o registro" . ". Erro: " . $e->getMessage();
	  }
	  mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao);
	}
	else if (strcasecmp($operacao, Constantes::EDITAR) == 0) {
   	try {
   	  $sql = "SELECT CS.IDPESSOA, P.NOME AS SUPLENTE, CS.IDCOMPOSICAOTITULAR, CS.IDDEPARTAMENTO, CS.PERTENCE,
              CS.INICIO, CS.TERMINO, CS.OBSERVACAO, CS.ATIVO, T.NOME AS TITULAR, C.CARGO
              FROM COMPOSICOESSUPLENTES CS INNER JOIN PESSOAS P
              ON(CS.IDPESSOA = P.ID) INNER JOIN COMPOSICOESTITULARES CT
              ON(CS.IDCOMPOSICAOTITULAR = CT.ID) INNER JOIN PESSOAS T
              ON(CT.IDPESSOA = T.ID) INNER JOIN CARGOS C
              ON(CT.IDCARGO = C.ID)
              WHERE CS.ID = $codigo AND CS.ATIVO = 'A'";
			$mensagem = null;
			$resultados = $suplentehelper->consultar($banco, null, null, null, $sql);
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
	$camposValores['idcomposicaotitular'] = isset($_POST['idtitular']) ? $_POST['idtitular'] : $_GET['idtitular'];
  $camposValores['idpessoa'] = isset($_POST['idpessoa']) ? $_POST['idpessoa'] : $_GET['idpessoa'];
  $camposValores['iddepartamento'] = isset($_POST['lstdepartamento']) ? $_POST['lstdepartamento'] : $_GET['lstdepartamento'];
  $camposValores['pertence'] = isset($_POST['lstpertence']) ? $_POST['lstpertence'] : $_GET['lstpertence'];
  $camposValores['inicio'] = str_replace("/",".", isset($_POST['edtinicio']) ? $_POST['edtinicio'] : $_GET['edtinicio']);
  $camposValores['termino'] = str_replace("/", ".", isset($_POST['edtermino']) ? $_POST['edtermino'] : $_GET['edtermino']);
  $camposValores['ativo'] = isset($_POST['lststatus']) ? $_POST['lststatus'] : $_GET['lststatus'];
  $camposValores['observacao'] = isset($_POST['edtobservacao']) ? $_POST['edtobservacao'] : $_GET['edtobservacao'];
	if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
   	$userlogado = $_SESSION[Constantes::OBJETO_USUARIO];
	}
	$camposValores['idusuario'] = isset($userlogado) ? $userlogado->getID() : null;
	return $camposValores;
}


function mostraTemplate(DAOBanco $banco, $resultados, $mensagem = null, $codigo = null, $operacao = null) {
  $nomesuplente = null;
  $idpessoa = null;
  $idtitular = null;
  $nometitular = null;
  $cargo = null;
  $depto_id = null;
  $pertence_id = null;
  $inicio = null;
  $termino = null;
  $status_id = null;
  $observacao = null;
 	$opcoesidstatus = array(Titular::STATUS_ATIVO,Titular::STATUS_INATIVO);
	$opcoesstatus = array("Ativo","Inativo");
	$opcoesidpertence = array(Titular::PERTENCE_CTA,Titular::PERTENCE_CONGREGRACAO);
	$opcoespertence = array("CTA","Congrega&ccedil;&atilde;o");
	if (count($resultados) > 0 ) {
	  foreach($resultados as $suplente) {
	    $idtitular = $suplente->getIDTitular();
      $nometitular = $suplente->getNomeTitular();
      $cargo = $suplente->getCargo();
	    $idpessoa = $suplente->getIDPessoa();
	    $nomesuplente = $suplente->getNomeSuplente();
	    $depto_id = $suplente->getIDEpto();
	    $pertence_id = $suplente->getPertence();
	    $inicio = $suplente->getInicio();
	    $termino = $suplente->getTermino();
	    $status_id = $suplente->getAtivo();
	    $observacao = $suplente->getObservacao();
	  }
  }
  $departamentos = array();
  $idepto = array();
  $sigla = array();
  try {
    $deptohelper = new DeptoHelper();
    $departamentos = $deptohelper->consultar($banco,null);
  }
  catch(Exception $e){
    $mensagem = "N&atilde;o foi poss&iacute;vel consultar os departamentos" . ". Erro: " . $e->getMessage();
  }
  if (count($departamentos) > 0 ) {
    $idepto[] = "";
    $sigla[] = "Selecione o Depto.";
    foreach($departamentos as $deptos) {
      $idepto[] = $deptos->getID();
      $sigla[] = $deptos->getSigla();
    }
  }
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("idtitular", $idtitular);
	$smarty->assign("nometitular", $nometitular);
	$smarty->assign("cargo", $cargo);
	$smarty->assign("nomesuplente", $nomesuplente);
	$smarty->assign("idpessoa", $idpessoa);
	$smarty->assign("opcoesidepto", $idepto);
	$smarty->assign("opcoesigla", $sigla);
	$smarty->assign("opcoesdeptopad", $depto_id);
	$smarty->assign("opcoesidpertence", $opcoesidpertence);
	$smarty->assign("opcoespertence", $opcoespertence);
	$smarty->assign("opcoespertencepad", $pertence_id);
	$smarty->assign("inicio", $inicio);
	$smarty->assign("termino", $termino);
	$smarty->assign("opcoesidstatus", $opcoesidstatus);
	$smarty->assign("opcoestatus", $opcoesstatus);
	$smarty->assign("opcoestatuspad", $status_id);
	$smarty->assign("observacao", $observacao);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("operacao", $operacao);
	$smarty->display("cadsuplente.tpl");
}
?>
