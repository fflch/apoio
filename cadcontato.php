<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$contatohelper = new ContatoHelper();
	operacao($contatohelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(ContatoHelper $contatohelper, DAOBanco $banco) {
	$codigo = 0;
	$idcontato = 0;
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
	if (isset($_GET['idcontato'])){
	  $idcontato = $_GET['idcontato'];
	}
	else if (isset($_POST['idcontato'])) {
	  $idcontato = $_POST['idcontato'];
  }
	$salvar = isset($_POST['salvar']) ? $_POST['salvar'] : null;
	date_default_timezone_set("America/Sao_Paulo");
	$resultados = array();
	$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $codigo));
  if (strcasecmp($operacao, Constantes::INSERIR) == 0 && !is_null($salvar)) {
    try {
	    $camposValores = populaCampos();
	    $contatohelper->incluir($banco, $camposValores);
	    $mensagem = "Registro inclu&iacute;do com sucesso";
    }
    catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel incluir o registro" . ". Erro: " . $e->getMessage();
	  }
	  mostraTemplate($contatohelper, $banco, $resultados, $mensagem, $codigo, $operacao);
	}
	else if (strcasecmp($operacao, Constantes::INSERIR) == 0) {
		mostraTemplate($contatohelper, $banco, $resultados, null, $codigo, $operacao);
	}
	else if (strcasecmp($operacao, Constantes::EXCLUIR) == 0) {
 		$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $idcontato));
		try {
			$contatohelper->excluir($banco, $filtro);
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel excluir o registro. Erro: "  . $e->getMessage();
		}
    mostraTemplate($contatohelper, $banco, $resultados, null, $codigo, $operacao = Constantes::INSERIR);
	}
}

function populaCampos() {
	$camposValores = array();
	$camposValores['idtipocontato'] = isset($_POST['lstipo']) ? $_POST['lstipo'] : $_GET['lstipo'];
	$camposValores['idpessoa'] = isset($_POST['codigo']) ? $_POST['codigo'] : $_GET['codigo'];
	$camposValores['contato'] = isset($_POST['edtcontato']) ? $_POST['edtcontato'] : $_GET['edtcontato'];
 	if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
   	$userlogado = $_SESSION[Constantes::OBJETO_USUARIO];
	}
	$camposValores['idusuario'] = isset($userlogado) ? $userlogado->getID() : null;
	return $camposValores;
}


function mostraTemplate(ContatoHelper $contatohelper, DAOBanco $banco, $resultados, $mensagem = null, $codigo = null, $operacao = null) {
  $opcoesidtipo = array();
  $opcoestipo = array();
  $tiposcontato = array();
  $contato = array();
  $tipo = array();
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$links_excluir = array();
  try {
    $tipocontatohelper = new TipoContatoHelper();
    $tiposcontato = $tipocontatohelper->consultar($banco, array("id", "tipo"));
  }
  catch(Exception $e){
    $mensagem = "N&atilde;o foi poss&iacute;vel consultar os contatos" . ". Erro: " . $e->getMessage();
  }
  $opcoesidtipo[] = "";
  $opcoestipo[] = "Selecione o Tipo";
  if (count($tiposcontato) > 0 ) {
    foreach($tiposcontato as $tipocontato) {
      $opcoesidtipo[] = $tipocontato->getID();
      $opcoestipo[] = $tipocontato->getTipo();
    }
  }

  if(!is_null($codigo) ) {
    try {
      $mensagem = null;
	    $sql = "SELECT C.ID, C.IDPESSOA, C.CONTATO, T.TIPO FROM CONTATOS C INNER JOIN TIPOSCONTATOS T
	            ON(C.IDTIPOCONTATO = T.ID) WHERE C.IDPESSOA = $codigo";
	    $resultados = $contatohelper->consultar($banco, null, null, null, $sql);
    }
    catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro" . ". Erro: " . $e->getMessage();
 	  }
  }

	if (count($resultados) > 0) {
		foreach ($resultados as $contatos) {
		  $tipo[] = $contatos->getTipo();
			$contato[] = $contatos->getContato();
  		$links_excluir[] = "cadcontato.php?operacao=" . Constantes::EXCLUIR . "&" . "idcontato=" . $contatos->getID() . "&" . "codigo=" . $contatos->getIDPessoa();
		}
	}
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("opcoesidtipo", $opcoesidtipo);
	$smarty->assign("opcoestipo", $opcoestipo);
	$smarty->assign("tipo", $tipo);
	$smarty->assign("contato", $contato);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("links_excluir", $links_excluir);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->assign("operacao", $operacao);
	$smarty->display("pcontato.tpl");
}
?>
