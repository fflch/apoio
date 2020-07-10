<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$titularhelper = new TitularHelper();
	operacao($titularhelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(TitularHelper $titularhelper, DAOBanco $banco) {
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
			$titularhelper->excluir($banco, $filtro);
			$mensagem = "Registro: " . $codigo . " exclu&iacute;do com sucesso.";
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel excluir o registro: " . $codigo . ". Erro: " . $e->getMessage();
		}
		mostraTemplate($titularhelper, $banco, $mensagem);
	}
	else if (strcasecmp($operacao, Constantes::CONSULTAR) == 0) {
		 $campo =  isset($_GET['lstcampo']) ? $_GET['lstcampo'] : null;
		 if (strcasecmp($campo, "con") == 0) {
			 $resultados = array();
			 try {
			   $sql = "SELECT CT.ID, C.CARGO, P.NOME FROM COMPOSICOESTITULARES CT INNER JOIN PESSOAS P
			           ON(CT.IDPESSOA = P.ID) INNER JOIN CARGOS C ON(CT.IDCARGO = C.ID)
			           WHERE CT.PERTENCE = '$campo' AND CT.ATIVO='A' ORDER BY P.NOME";
				 $resultados = $titularhelper->consultar($banco, null, null, null, $sql);
		   }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar o titular " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($titularhelper, $banco, $mensagem = null, $resultados, $campo);
		 }
  	 else if (strcasecmp($campo, "cta") == 0) {
			 $resultados = array();
			 try {
			   $sql = "SELECT CT.ID, C.CARGO, P.NOME FROM COMPOSICOESTITULARES CT INNER JOIN PESSOAS P
			           ON(CT.IDPESSOA = P.ID) INNER JOIN CARGOS C ON(CT.IDCARGO = C.ID)
			           WHERE CT.PERTENCE = '$campo' AND CT.ATIVO='A' ORDER BY P.NOME";
				 $resultados = $titularhelper->consultar($banco, null, null, null, $sql);
		   }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar o titular " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($titularhelper, $banco, $mensagem = null, $resultados, $campo);
		 }
	}
  else {
		 mostraTemplate($titularhelper, $banco);
	}
}

function mostraTemplate(TitularHelper $titularhelper, DAOBanco $banco, $mensagem = null, $resultados = null, $campo = 'cta') {
	$codigo = array();
	$nome   = array();
	$cargo  = array();
	$links_excluir = array();
	$links_editar = array();
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$link_consultar = "admtitular.php?operacao=" . Constantes::CONSULTAR ."&";
	$opcoesidcomposicao = array(Suplente::PERTENCE_CTA,Suplente::PERTENCE_CONGREGRACAO);
	$opcoescomposicao = array("CTA","Congrega&ccedil;&atilde;o");
	$opcoescomposicaopad =  isset($_POST['lstcampo']) ? $_POST['lstcampo'] : $campo;

	if (is_null($resultados)) {
	  try {
			$sql = "SELECT CT.ID, C.CARGO, P.NOME FROM COMPOSICOESTITULARES CT INNER JOIN PESSOAS P
			       ON(CT.IDPESSOA = P.ID) INNER JOIN CARGOS C ON(CT.IDCARGO = C.ID)
			       WHERE CT.PERTENCE = 'cta' AND CT.ATIVO='A' ORDER BY P.NOME";
			$resultados = $titularhelper->consultar($banco, null, null, null, $sql);
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel consultar a composi&ccedil;&atilde;o de titulares" . ". Erro: " . $e->getMessage();
		}
	}
	$total = count($resultados);
	foreach ($resultados as $titulares) {
		$codigo[] = $titulares->getId();
		$nome[]  = $titulares->getNome();
		$cargo[] = $titulares->getCargo();
		$links_editar[] = "cadtitular.php?operacao=" . Constantes::EDITAR . "&" . "codigo=" . $titulares->getId();
		$links_excluir[] = $_SERVER['PHP_SELF'] . "?operacao=" . Constantes::EXCLUIR . "&" . "codigo=" . $titulares->getId();
	}

	if (strcasecmp($campo, "cta") == 0) {
	  $tipo = "CTA";
	}
	else {
	  $tipo = "Congrega&ccedil;&atilde;o";
	}

	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("nome", $nome);
	$smarty->assign("cargo", $cargo);
	$smarty->assign("opcoesidcomposicao", $opcoesidcomposicao);
  $smarty->assign("opcoescomposicao", $opcoescomposicao);
	$smarty->assign("opcoescomposicaopad", $opcoescomposicaopad);
	$smarty->assign("links_editar", $links_editar);
	$smarty->assign("links_excluir", $links_excluir);
	$smarty->assign("link_consultar", $link_consultar);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->assign("tipo", $tipo);
	$smarty->assign("total", $total);
	$smarty->display("admtitular.tpl");
}
?>
