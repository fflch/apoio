<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$suplentehelper = new SuplenteHelper();
	operacao($suplentehelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(SuplenteHelper $suplentehelper, DAOBanco $banco) {
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
			$suplentehelper->excluir($banco, $filtro);
			$mensagem = "Registro: " . $codigo . " exclu&iacute;do com sucesso.";
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel excluir o registro: " . $codigo . ". Erro: " . $e->getMessage();
		}
		mostraTemplate($suplentehelper, $banco, $mensagem);
	}
	else if (strcasecmp($operacao, Constantes::CONSULTAR) == 0) {
		 $campo =  isset($_GET['lstcampo']) ? $_GET['lstcampo'] : null;
		 if (strcasecmp($campo, "con") == 0) {
			 $resultados = array();
			 try {
			   $sql = "SELECT CS.ID, P.NOME AS SUPLENTE, T.NOME AS TITULAR FROM COMPOSICOESSUPLENTES CS
			           INNER JOIN PESSOAS P ON(CS.IDPESSOA = P.ID) INNER JOIN COMPOSICOESTITULARES CT
                 ON(CS.IDCOMPOSICAOTITULAR = CT.ID) INNER JOIN PESSOAS T
                 ON(CT.IDPESSOA = T.ID) WHERE CS.PERTENCE = '$campo' AND CS.ATIVO='A'";
				 $resultados = $suplentehelper->consultar($banco, null, null, null, $sql);
		   }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar o titular " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($suplentehelper, $banco, $mensagem = null, $resultados, $campo);
		 }
  	 else if (strcasecmp($campo, "cta") == 0) {
			 $resultados = array();
			 try {
			   $sql = "SELECT CS.ID, P.NOME AS SUPLENTE, T.NOME AS TITULAR FROM COMPOSICOESSUPLENTES CS
			           INNER JOIN PESSOAS P ON(CS.IDPESSOA = P.ID) INNER JOIN COMPOSICOESTITULARES CT
                 ON(CS.IDCOMPOSICAOTITULAR = CT.ID) INNER JOIN PESSOAS T
                 ON(CT.IDPESSOA = T.ID) WHERE CS.PERTENCE = '$campo' AND CS.ATIVO='A'";
				 $resultados = $suplentehelper->consultar($banco, null, null, null, $sql);
		   }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar o titular " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($suplentehelper, $banco, $mensagem = null, $resultados, $campo);
		 }
	}
  else {
		 mostraTemplate($suplentehelper, $banco);
	}
}

function mostraTemplate(SuplenteHelper $suplentehelper, DAOBanco $banco, $mensagem = null, $resultados = null, $campo = 'cta') {
	$codigo = array();
	$nometitular   = array();
	$nomesuplente  = array();
	$links_excluir = array();
	$links_editar = array();
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$link_consultar = "admsuplente.php?operacao=" . Constantes::CONSULTAR ."&";
	$opcoesidcomposicao = array(Suplente::PERTENCE_CTA,Suplente::PERTENCE_CONGREGRACAO);
	$opcoescomposicao = array("CTA","Congrega&ccedil;&atilde;o");
	$opcoescomposicaopad =  isset($_POST['lstcampo']) ? $_POST['lstcampo'] : $campo;

	if (is_null($resultados)) {
	  try {
      $sql = "SELECT CS.ID, P.NOME AS SUPLENTE, T.NOME AS TITULAR FROM COMPOSICOESSUPLENTES CS
			        INNER JOIN PESSOAS P ON(CS.IDPESSOA = P.ID) INNER JOIN COMPOSICOESTITULARES CT
              ON(CS.IDCOMPOSICAOTITULAR = CT.ID) INNER JOIN PESSOAS T
              ON(CT.IDPESSOA = T.ID) WHERE CS.PERTENCE = '$campo' AND CS.ATIVO='A'";
      $resultados = $suplentehelper->consultar($banco, null, null, null, $sql);
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel consultar a composi&ccedil;&atilde;o de titulares" . ". Erro: " . $e->getMessage();
		}
	}
	$total = count($resultados);
	foreach ($resultados as $suplentes) {
		$codigo[] = $suplentes->getID();
		$nometitular[]  = $suplentes->getNomeTitular();
		$nomesuplente[] = $suplentes->getNomeSuplente();
		$links_editar[] = "cadsuplente.php?operacao=" . Constantes::EDITAR . "&" . "codigo=" . $suplentes->getId();
		$links_excluir[] = $_SERVER['PHP_SELF'] . "?operacao=" . Constantes::EXCLUIR . "&" . "codigo=" . $suplentes->getId();
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
	$smarty->assign("nometitular", $nometitular);
	$smarty->assign("nomesuplente", $nomesuplente);
	$smarty->assign("opcoesidcomposicao", $opcoesidcomposicao);
  $smarty->assign("opcoescomposicao", $opcoescomposicao);
	$smarty->assign("opcoescomposicaopad", $opcoescomposicaopad);
	$smarty->assign("links_editar", $links_editar);
	$smarty->assign("links_excluir", $links_excluir);
	$smarty->assign("link_consultar", $link_consultar);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->assign("tipo", $tipo);
	$smarty->assign("total", $total);
	$smarty->display("admsuplente.tpl");
}
?>
