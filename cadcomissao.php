<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$comissaohelper = new ComissaoHelper();
	operacao($comissaohelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(ComissaoHelper $comissaohelper, DAOBanco $banco) {
	$codigo = 0;
	$idconcursopessoa = 0;
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
	if (isset($_GET['idconcursopessoa'])){
	  $idconcursopessoa = $_GET['idconcursopessoa'];
	}
	else if (isset($_POST['idconcursopessoa'])) {
	  $idconcursopessoa = $_POST['idconcursopessoa'];
  }
  if ($idconcursopessoa <> 0 ) {
    $ids = explode("-",$idconcursopessoa);
	  $idconcurso   = $ids[0];
	  $codigo = $ids[0];
	  $idpessoa = $ids[1];
  }
	$salvar = isset($_POST['salvar']) ? $_POST['salvar'] : null;
	date_default_timezone_set("America/Sao_Paulo");
	$resultados = array();
	$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $codigo));
	if (strcasecmp($operacao, Constantes::INSERIR) == 0 && !is_null($salvar)) {
    try {
	    $camposValores = populaCampos();
	    $comissaohelper->incluir($banco, $camposValores);
	    $mensagem = "Registro inclu&iacute;do com sucesso";
    }
    catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel incluir o registro" . ". Erro: " . $e->getMessage();
	  }
	  mostraTemplate($comissaohelper, $banco, $resultados, $mensagem, $codigo, $operacao);
	}
	else if (strcasecmp($operacao, Constantes::INSERIR) == 0) {
  	mostraTemplate($comissaohelper, $banco, $resultados, null, $codigo, $operacao);
	}
	else if (strcasecmp($operacao, Constantes::EXCLUIR) == 0) {
 		$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idconcurso" => $idconcurso, "idpessoa" => $idpessoa));
		try {
			$comissaohelper->excluir($banco, $filtro);
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel excluir o registro. Erro: "  . $e->getMessage();
		}
    mostraTemplate($comissaohelper, $banco, $resultados, null, $codigo, $operacao = Constantes::INSERIR);
	}
}

function populaCampos() {
	$camposValores = array();
	$camposValores['idconcurso'] = isset($_POST['codigo']) ? $_POST['codigo'] : $_GET['codigo'];
	$camposValores['idpessoa'] = isset($_POST['idpessoa']) ? $_POST['idpessoa'] : $_GET['idpessoa'];
	$camposValores['origem'] = isset($_POST['lstorigem']) ? $_POST['lstorigem'] : $_GET['lstorigem'];
	if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
   	$userlogado = $_SESSION[Constantes::OBJETO_USUARIO];
	}
	$camposValores['idusuario'] = isset($userlogado) ? $userlogado->getID() : null;
	return $camposValores;
}


function mostraTemplate(ComissaoHelper $comissaohelper, DAOBanco $banco, $resultados, $mensagem = null, $codigo = null, $operacao = null) {
	$idpessoa = array();
	$nome = array();
	$titulo = array();
	$origem = array();
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$links_excluir = array();
  if(!is_null($codigo) ) {
    try {
      $mensagem = null;
	    $sql = "SELECT C.IDCONCURSO, C.IDPESSOA, P.NOME, C.TITULO, C.ORIGEM FROM COMISSOES C INNER JOIN PESSOAS P
	            ON(C.IDPESSOA = P.ID) WHERE IDCONCURSO = $codigo ORDER BY C.ORIGEM, P.NOME";
	    $resultados = $comissaohelper->consultar($banco, null, null, null, $sql);
    }
    catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro" . ". Erro: " . $e->getMessage();
 	  }
  }
	if (count($resultados) > 0) {
		foreach ($resultados as $comissoes) {
			$nome[] = $comissoes->getNome();
			$origem[] = $comissoes->getOrigem();
			$titulo[] = $comissoes->getTitulo();
  		$links_excluir[] = "cadcomissao.php?operacao=" . Constantes::EXCLUIR . "&" . "idconcursopessoa=" . $comissoes->getIDConcurso() . "-" . $comissoes->getIDPessoa();
		}
	}
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("nome", $nome);
	$smarty->assign("titulo", $titulo);
	$smarty->assign("origem", $origem);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("links_excluir", $links_excluir);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->assign("operacao", $operacao);
	$smarty->display("pcomissao.tpl");
}
?>
