<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$inscritohelper = new InscritoHelper();
	operacao($inscritohelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(InscritoHelper $inscritohelper, DAOBanco $banco) {
	$codigo = 0;
	$operacao = "";
	$idconcurso = 0;
	$idpessoa = 0;
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
	if ($codigo <> 0) {
    $ids = explode("-",$codigo);
    $idconcurso = $ids[0];
    $idpessoa = $ids[1];
	}
	$salvar = isset($_POST['salvar']) ? $_POST['salvar'] : null;
	date_default_timezone_set("America/Sao_Paulo");
	$resultados = array();
	$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idconcurso" => $idconcurso, "idpessoa" => $idpessoa));
	if (strcasecmp($operacao, Constantes::EDITAR) == 0 && !is_null($salvar)) {
 		try {
	    $camposValores = populaCampos();
	    $inscritohelper->alterar($banco, $camposValores, $filtro);
	    $mensagem = "Registro alterado com sucesso";
    }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel alterar o registro - Erro: " . $e->getMessage();
	  }
	  try {
  	  $sql = "SELECT CC.IDCONCURSO, CC.IDPESSOA, CC.PROCESSO, C.EDITAL, C.DESCRICAO, C.STATUS, P.NOME FROM CONCURSOSXCANDIDATOS CC INNER JOIN CONCURSOS C
   	  ON(CC.IDCONCURSO = C.ID) INNER JOIN PESSOAS P ON(CC.IDPESSOA = P.ID) WHERE CC.IDCONCURSO = $idconcurso AND CC.IDPESSOA = $idpessoa;";
	    $resultados = $inscritohelper->consultar($banco, null, null, null, $sql);
	  }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro alterado" . ". Erro: " . $e->getMessage();
	  }
	  mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao);
  }
	else if (strcasecmp($operacao, Constantes::INSERIR) == 0 && !is_null($salvar)) {
    try {
      $resultado = null;
	    $camposValores = populaCampos();
	    $resultado = $inscritohelper->incluir($banco, $camposValores);
	    $mensagem = "Registro inclu&iacute;do com sucesso";
    }
    catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel incluir o registro" . ". Erro: " . $e->getMessage();
	  }

//
    $id_concurso = isset($_POST['lstconcurso']) ? $_POST['lstconcurso'] : $_GET['lstconcurso'];
    $id_pessoa = isset($_POST['idpessoa']) ? $_POST['idpessoa'] : $_GET['idpessoa'];
		if (!is_null($resultado)) {
    	header("location:gerarecibo.php?codigo=$id_concurso"."-".$id_pessoa);      		
		}
		else {
//	
	  mostraTemplate($banco, $resultados, $mensagem, $codigo=$id_concurso.'-'.$id_pessoa, $operacao);
	}
	
}	
	
	
	else if (strcasecmp($operacao, Constantes::EDITAR) == 0) {
   	try {
   	  $sql = "SELECT CC.IDCONCURSO, CC.IDPESSOA, CC.PROCESSO, C.EDITAL, C.DESCRICAO, C.STATUS, P.NOME FROM CONCURSOSXCANDIDATOS CC INNER JOIN CONCURSOS C
   	  ON(CC.IDCONCURSO = C.ID) INNER JOIN PESSOAS P ON(CC.IDPESSOA = P.ID) WHERE CC.IDCONCURSO = $idconcurso AND CC.IDPESSOA = $idpessoa;";
			$mensagem = null;
			$resultados = $inscritohelper->consultar($banco, null, null, null, $sql);
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
	$camposValores['idconcurso'] = isset($_POST['lstconcurso']) ? $_POST['lstconcurso'] : $_GET['lstconcurso'];
	$camposValores['idpessoa'] = isset($_POST['idpessoa']) ? $_POST['idpessoa'] : $_GET['idpessoa'];
	$camposValores['processo'] = isset($_POST['edtprocesso']) ? $_POST['edtprocesso'] : $_GET['edtprocesso'];
	if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
   	$userlogado = $_SESSION[Constantes::OBJETO_USUARIO];
	}
	$camposValores['idusuario'] = isset($userlogado) ? $userlogado->getID() : null;
	return $camposValores;
}


function mostraTemplate(DAOBanco $banco, $resultados, $mensagem = null, $codigo = null, $operacao = null) {
  $idconcurso = "";
	$idpessoa = "";
  $processo = "";
  $nome = "";
  $concurso = "";
  $status = "";
  $concursos = array();
  $opcoesidconcurso = array();
  $opcoesedital = array();
  $opcoesconcursopad = array();
  $opcoesidconcurso[] = "";
  $opcoesedital[] = "Selecione o Edital";
  if (count($resultados) > 0) {
		foreach ($resultados as $inscrito) {
			$idconcurso = $inscrito->getIDConcurso();
			$idpessoa = $inscrito->getIDPessoa();
			$processo = $inscrito->getProcesso();
			$nome = $inscrito->getNome();
			$concurso = $inscrito->getEdital();
			$status = $inscrito->getStatus();
		}
		$opcoesconcursopad[] = $idconcurso;
  	$opcoesedital[] = $concurso;
	  $opcoesidconcurso[] = $idconcurso;
		
	}
#	if ($status == "F" or $status == "C") {
#  	$opcoesdescricao[] = $concurso;
#	  $opcoesidconcurso[] = $idconcurso;
#  }
  elseif ($operacao == "inserir") {
	  $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("status" => "A"));
    try {
      $concursohelper = new ConcursoHelper();
      $concursos = $concursohelper->consultar($banco, array("id","edital"), $filtro);
    }
    catch(Exception $e){
      $mensagem = "N&atilde;o foi poss&iacute;vel consultar os editais" . ". Erro: " . $e->getMessage();
    }
    if (count($concursos) > 0 ) {
      foreach($concursos as $concurso) {
        $opcoesidconcurso[] = $concurso->getID();
        $opcoesedital[] = $concurso->getEdital();
      }
    }
  }
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("opcoesidconcurso", $opcoesidconcurso);
	$smarty->assign("opcoesconcurso", $opcoesedital);
	$smarty->assign("opcoesconcursopad", $opcoesconcursopad);
	$smarty->assign("nome", $nome);
	$smarty->assign("idpessoa", $idpessoa);
	$smarty->assign("processo", $processo);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("operacao", $operacao);
	$smarty->display("cadinscrito.tpl");
}
?>
