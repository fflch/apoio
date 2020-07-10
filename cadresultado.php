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
  $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idconcurso" => $codigo));
	if (strcasecmp($operacao, Constantes::EDITAR) == 0 && !is_null($salvar)) {
    $camposValores = populaCampos();
    $erro = 0;
    for ( $x=0; $x < count($camposValores['idpessoa']); $x++ ) {
      $campos = array();
      $camposAtualizaveis = array();
      foreach ($camposValores as $chave => $valor) {
        $campos[$chave] =  $camposValores[$chave][$x];
        if ($chave == 'nota' || $chave == 'conceito' || $chave == 'idusuario') {
          if ($camposValores[$chave][$x] <> '') {
            $camposAtualizaveis[$chave] = $camposValores[$chave][$x];
          }
        }
        else if ( $chave == 'idpessoa') {
          $filtro->adicionaCampoFiltro($chave, $camposValores[$chave][$x]);
        }
      }
      try {
        $inscritohelper->alterar($banco, $camposAtualizaveis, $filtro);
        $filtro->removeCampoFiltro('idpessoa');
	      $mensagem = "Registro: alterado com sucesso.";
	    }
	    catch (Exception $e) {
	      $erro = 1;
	      $mensagem = "N&atilde;o foi poss&iacute;vel alterar o registro: " . $codigo . ". Erro: " . $e->getMessage();
	    }
	  }
    if ($erro == 0) {
      $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $codigo));
  	  try {
	      $concursohelper = new ConcursoHelper();
	      $concursohelper->alterar($banco, array("STATUS" => "F"), $filtro);
  	  }
  	  catch(Exception $e) {
   	    $mensagem = "N&atilde;o foi poss&iacute;vel finalizar o concurso. Erro: " . $e->getMessage();
  	  }
    }
	  try {
	    $sql = "SELECT CC.IDCONCURSO, C.DESCRICAO, CC.IDPESSOA, CC.NOTA, CC.CONCEITO, P.NOME FROM CONCURSOSXCANDIDATOS CC
			        INNER JOIN PESSOAS P ON(CC.IDPESSOA = P.ID) INNER JOIN CONCURSOS C ON(CC.IDCONCURSO = C.ID) WHERE CC.IDCONCURSO = $codigo";
	    $resultados = $inscritohelper->consultar($banco, null, null, null, $sql);
	  }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro alterado" . ". Erro: " . $e->getMessage();
	  }
	  mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao);
  }
	else if (strcasecmp($operacao, Constantes::EDITAR) == 0) {
   	try {
			$mensagem = null;
			$sql = "SELECT CC.IDCONCURSO, C.DESCRICAO, CC.IDPESSOA, CC.NOTA, CC.CONCEITO, P.NOME FROM CONCURSOSXCANDIDATOS CC
			        INNER JOIN PESSOAS P ON(CC.IDPESSOA = P.ID) INNER JOIN CONCURSOS C ON(CC.IDCONCURSO = C.ID) WHERE CC.IDCONCURSO = $codigo";
			$resultados = $inscritohelper->consultar($banco, null, null, null, $sql);
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro" . ". Erro: " . $e->getMessage();
		}
		mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao);
	}
}

function populaCampos() {
	$camposValores = array();
	$camposValores['nota'] = isset($_POST['edtnota']) ? $_POST['edtnota'] : $_GET['edtnota'];
	$camposValores['conceito'] = isset($_POST['lstconceito']) ? $_POST['lstconceito'] : $_GET['lstconceito'];
	$camposValores['idusuario'] = isset($_POST['idusuario']) ? $_POST['idusuario'] : $_GET['idusuario'];
	$camposValores['idpessoa'] = isset($_POST['idpessoa']) ? $_POST['idpessoa'] : $_GET['idpessoa'];
	return $camposValores;
}

function mostraTemplate(DAOBanco $banco, $resultados, $mensagem = null, $codigo = null, $operacao = null) {
	$idpessoa = array();
	$candidato = array();
	$nota = array();
	$conceito = array();
	$descricao = "";
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$total = 0;
	if (count($resultados) > 0) {
	  $total = count($resultados);
		foreach ($resultados as $inscrito) {
		  $idpessoa[] = $inscrito->getIDPessoa();
			$candidato[] = $inscrito->getNome();
			$nota[] = $inscrito->getNota();
			$conceito[] = $inscrito->getConceito();
			$descricao = $inscrito->getDescricao();
		}
	}
	else {
	  $mensagem = "N&atilde;o h&aacute; inscri&ccedil;&otilde;es para o concurso selecionado.";
	}

  $opcoesconceito = array("","Aprovado e Indicado","Aprovado","Reprovado","Desistente");

	if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
   	$userlogado = $_SESSION[Constantes::OBJETO_USUARIO];
	}
	$idusuario = isset($userlogado) ? $userlogado->getID() : null;
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("idpessoa", $idpessoa);
	$smarty->assign("candidato", $candidato);
	$smarty->assign("nota", $nota);
  $smarty->assign("opcoesconceitopad", $conceito);
	$smarty->assign("opcoesconceito", $opcoesconceito);
	$smarty->assign("descricao", $descricao);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("idusuario", $idusuario);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->assign("operacao", $operacao);
	$smarty->assign("total", $total);
	$smarty->display("cadresultado.tpl");
}
?>
