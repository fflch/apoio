<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$titulacaohelper = new TitulacaoHelper();
	operacao($titulacaohelper, $banco);
}
else {
	header("location:index.php");
}

function operacao(TitulacaoHelper $titulacaohelper, DAOBanco $banco) {
	$codigo = 0;
	$idtitulacaopessoa = 0;
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
	if (isset($_GET['idtitulacaopessoa'])){
	  $idtitulacaopessoa = $_GET['idtitulacaopessoa'];
	}
	else if (isset($_POST['idtitulacaopessoa'])) {
	  $idtitulacaopessoa = $_POST['idtitulacaopessoa'];
  }
  if ($idtitulacaopessoa <> 0 ) {
    $ids = explode("-",$idtitulacaopessoa);
	  $idpessoa   = $ids[0];
	  $codigo = $ids[0];
	  $idtitulacao = $ids[1];
  }
	$salvar = isset($_POST['salvar']) ? $_POST['salvar'] : null;
	date_default_timezone_set("America/Sao_Paulo");
	$resultados = array();
	$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $codigo));
	if (strcasecmp($operacao, Constantes::INSERIR) == 0 && !is_null($salvar)) {
    try {
	    $camposValores = populaCampos();
	    $titulacaohelper->incluir($banco, $camposValores);
	    $mensagem = "Registro inclu&iacute;do com sucesso";
    }
    catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel incluir o registro" . ". Erro: " . $e->getMessage();
	  }
	  mostraTemplate($titulacaohelper, $banco, $resultados, $mensagem, $codigo, $operacao);
	}
	else if (strcasecmp($operacao, Constantes::INSERIR) == 0) {
		mostraTemplate($titulacaohelper, $banco, $resultados, null, $codigo, $operacao);
	}
	else if (strcasecmp($operacao, Constantes::EXCLUIR) == 0) {
 		$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idtitulacao" => $idtitulacao, "idpessoa" => $idpessoa));
		try {
			$titulacaohelper->excluir($banco, $filtro);
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel excluir o registro. Erro: "  . $e->getMessage();
		}
    mostraTemplate($titulacaohelper, $banco, $resultados, null, $codigo, $operacao = Constantes::INSERIR);
	}

}

function populaCampos() {
	$camposValores = array();
	$camposValores['idtitulacao'] = isset($_POST['lstitulacao']) ? $_POST['lstitulacao'] : $_GET['lstitulacao'];
	$camposValores['idpessoa'] = isset($_POST['codigo']) ? $_POST['codigo'] : $_GET['codigo'];
	$camposValores['ativo'] = 'S';
 	if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
   	$userlogado = $_SESSION[Constantes::OBJETO_USUARIO];
	}
	$camposValores['idusuario'] = isset($userlogado) ? $userlogado->getID() : null;
	return $camposValores;
}


function mostraTemplate(TitulacaoHelper $titulacaohelper, DAOBanco $banco, $resultados, $mensagem = null, $codigo = null, $operacao = null) {
  $idtitulacao = array();
  $titulacao = array();
  $status = array();

  $titulos = array();
  $idtitulo = array();
  $titulo = array();
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$links_excluir = array();
  try {
    $titulohelper = new TituloHelper();
    $sql = "SELECT ID, TITULO FROM TITULACOES WHERE ID NOT IN (SELECT IDTITULACAO FROM TITULACOESPESSOAS WHERE IDPESSOA = $codigo)";
    $titulos = $titulohelper->consultar($banco, null, null, null, $sql);
  }
  catch(Exception $e){
    $mensagem = "N&atilde;o foi poss&iacute;vel consultar os t&iacute;tulos" . ". Erro: " . $e->getMessage();
  }
  $idtitulo[] = "";
  $titulo[] = "Selecione o T&iacute;tulo";
  if (count($titulos) > 0 ) {

    foreach($titulos as $tit) {
      $idtitulo[] = $tit->getID();
      $titulo[] = $tit->getTitulo();
    }
  }
  if(!is_null($codigo) ) {
    try {
      $mensagem = null;
	    $sql = "SELECT TP.IDPESSOA, TP.IDTITULACAO, TP.ATIVO, T.TITULO FROM TITULACOESPESSOAS TP INNER JOIN TITULACOES T
	            ON(TP.IDTITULACAO = T.ID) WHERE TP.IDPESSOA = $codigo";
	    $resultados = $titulacaohelper->consultar($banco, null, null, null, $sql);
    }
    catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro" . ". Erro: " . $e->getMessage();
 	  }
  }
	if (count($resultados) > 0) {
		foreach ($resultados as $titulacaopessoa) {
		  $idtitulacao[] = $titulacaopessoa->getID();
			$titulacao[] = $titulacaopessoa->getTitulo();
			$status[] = $titulacaopessoa->getAtivo();
  		$links_excluir[] = "cadtitulacao.php?operacao=" . Constantes::EXCLUIR . "&" . "idtitulacaopessoa=" . $titulacaopessoa->getIDPessoa() . "-" . $titulacaopessoa->getIDTitulacao();
		}
	}
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("opcoestitulo", $titulo);
	$smarty->assign("opcoesidtitulo", $idtitulo);
	$smarty->assign("titulacao", $titulacao);
	$smarty->assign("status", $status);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("links_excluir", $links_excluir);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->assign("operacao", $operacao);
	$smarty->display("ptitulacao.tpl");
}
?>
