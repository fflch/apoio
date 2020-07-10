<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once('classes/Loader.class.php');
require_once('includes/retornasmarty.inc.php');
require_once('includes/confconexao.inc.php');
require_once('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$pessoahelper = new PessoaHelper();
	operacao($pessoahelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(PessoaHelper $pessoahelper, DAOBanco $banco) {
	$operacao = "";
	$codigo = 0;
	$mensagem = null;
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
			$pessoahelper->excluir($banco, $filtro);
			$mensagem = "Registro: " . $codigo . " exclu&iacute;do com sucesso.";
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel excluir o registro: " . $codigo . ". Erro: " . $e->getMessage();
		}
		if (isset($_GET['lstcampo'])) {
  		$campo =  isset($_GET['lstcampo']) ? $_GET['lstcampo'] : null;
		  $campovalor = isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null;
		  $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
		  if (strcasecmp($campo, "nome") == 0) {
		    montaPaginacao($pessoahelper, $banco, $mensagem, $campo, $campovalor, $pagina);
		  }
		  else {
  		  mostraTemplate($pessoahelper, $banco, $mensagem);
		  }
		}
	}
	else if (strcasecmp($operacao, Constantes::CONSULTAR) == 0) {
		 $campo =  isset($_GET['lstcampo']) ? $_GET['lstcampo'] : null;
		 $campovalor = isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null;
		 if (strcasecmp($campo, "nusp") == 0) {
			 $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("nusp" => $campovalor));
			 $resultados = array();
			 try {
				 $resultados = $pessoahelper->consultar($banco, null, $filtro);
		   }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar a pessoa" . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($pessoahelper, $banco, $mensagem = null, $resultados);
		 }
		 else if (strcasecmp($campo, "nome") == 0) {
			 $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : null;
			 montaPaginacao($pessoahelper, $banco, $mensagem, $campo, $campovalor, $pagina);
		 }
	 }
	 else {
		 mostraTemplate($pessoahelper, $banco);
	 }
}

function mostraTemplate(PessoaHelper $pessoahelper, DAOBanco $banco, $mensagem = null, $resultados = null, $pages = null) {
	$codigo = array();
	$nome   = array();
	$links_excluir = array();
	$links_editar = array();
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$link_consultar = "admpessoa.php?operacao=" . Constantes::CONSULTAR ."&";
  $campo =  isset($_GET['lstcampo']) ? $_GET['lstcampo'] : null;
	$campovalor = isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null;
  $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
	$opcoesidcampo = array("nome","nusp");
	$opcoescampo = array("Nome","N&ordm; USP");
	$opcoescampopad = $campo;
  if (is_null($resultados)) {
    $mensagem_total = "";
  }
  else {
    $mensagem_total = "Total de registro(s) encontrado(s) = " . count($resultados);
  }
	if (count($resultados) > 0) {
	  if (count($resultados) > 1 ) {
      $mensagem_total = "Total de registro(s) encontrado(s) = " . $_SESSION["TOTAL_REGISTRO"];
    }
	  foreach($resultados as $pessoas) {
      $codigo[] = $pessoas->getID();
	    $nome[] = $pessoas->getNome();
	    $links_editar[] = "cadpessoa.php?operacao=" . Constantes::EDITAR . "&" . "codigo=" . $pessoas->getId();
  		$links_excluir[] = $_SERVER['PHP_SELF']."?operacao=".Constantes::EXCLUIR."&"."codigo=".$pessoas->getId()."&lstcampo=$campo&edtpesquisa=$campovalor&pagina=$pagina";
	  }
	}
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("nome", $nome);
	$smarty->assign("opcoesidcampo", $opcoesidcampo);
	$smarty->assign("opcoescampo", $opcoescampo);
	$smarty->assign("opcoescampopad", $opcoescampopad);
	$smarty->assign("campovalor", utf8_decode($campovalor));
	$smarty->assign("links_editar", $links_editar);
	$smarty->assign("links_excluir", $links_excluir);
	$smarty->assign("link_consultar", $link_consultar);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->assign("pages", $pages);
	$smarty->assign("mensagem_total", $mensagem_total);
	$smarty->display("admpessoa.tpl");
}

function montaPaginacao(PessoaHelper $pessoahelper, DAOBanco $banco, $mensagem, $campo, $campovalor, $pagina) {
  $resultados = array();
	$total_registro = 0;
	$pages = null;
  $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_CONTEM, array("nome" => urlencode("%$campovalor%")));
	try {
		$resultados = $pessoahelper->consultar($banco, array("id", "nome"), $filtro, array("nome"));
    if ($resultados > 0) {
      $total_registro = count($resultados);
      $_SESSION["TOTAL_REGISTRO"] = $total_registro;
	  }
  	if ($total_registro > 0) {
  	  $pag = new Paginacao();
  	  $pag->setPor_Pagina(20);
      $sql = "SELECT FIRST <por_pagina> SKIP <skip> ID, NOME FROM PESSOAS WHERE NOME LIKE '%".utf8_decode($campovalor)."%' ORDER BY NOME;";
      $pag->__start($banco, $sql, $pagina, $total_registro, $pessoahelper);
      $pag->setEstilo("2");
      $pag->setUrlAdicional("operacao=".Constantes::CONSULTAR."&lstcampo=$campo&edtpesquisa=".urlencode($campovalor));  //Define a url adicional passada por parâmetro via url opcional;
      $resultados = $pag->getResult();
      if ($total_registro > $pag->getNporPg()) {
     	  $pages = $pag->getAnterior("paginacao_on","paginacao_off").$pag->getPaginas("paginacao_paginas").$pag->getProximo("paginacao_on","paginacao_off");
     	}
    }
	}
	catch (Exception $e) {
	  $mensagem = "N&atilde;o foi poss&iacute;vel consultar de pessoas " . ". Erro: " . $e->getMessage();
	}
	mostraTemplate($pessoahelper, $banco, $mensagem, $resultados, $pages);
}

?>
