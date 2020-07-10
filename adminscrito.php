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
	$operacao = "";
	$codigo = 0;
	$idconcurso = 0;
	$idpessoa = 0;
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
	if ($codigo <> 0) {
    $ids = explode("-",$codigo);
    $idconcurso = $ids[0];
    $idpessoa = $ids[1];
	}
	if (strcasecmp($operacao, Constantes::EXCLUIR) == 0) {
		$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idconcurso" => $idconcurso, "idpessoa" => $idpessoa));
		try {
			$inscritohelper->excluir($banco, $filtro);
			$mensagem = "Registro exclu&iacute;do com sucesso.";
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel excluir o registro: " . $codigo . ". Erro: " . $e->getMessage();
		}
		if (isset($_GET['lstcampo'])) {
  		$campo =  isset($_GET['lstcampo']) ? $_GET['lstcampo'] : null;
		  $campovalor = isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null;
		  $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
	    montaPaginacao($inscritohelper, $banco, $mensagem, $campo, $campovalor, $pagina);
	  }
		else {
  		  mostraTemplate($inscritohelper, $banco, $mensagem);
		}
	}
	else if (strcasecmp($operacao, Constantes::CONSULTAR) == 0) {
		 $campo =  isset($_GET['lstcampo']) ? $_GET['lstcampo'] : null;
		 $campovalor = isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null;
		 $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : null;
		 montaPaginacao($inscritohelper, $banco, $mensagem, $campo, $campovalor, $pagina);
	}
	else {
		 mostraTemplate($inscritohelper, $banco);
	}
}

function mostraTemplate(InscritoHelper $inscritohelper, DAOBanco $banco, $mensagem = null, $resultados = null, $pages = null) {
	$codigo    = array();
	$candidato = array();
	$edital = array();
	$links_recibo = array();
	$links_excluir = array();
	$links_editar = array();
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$link_consultar = "adminscrito.php?operacao=" . Constantes::CONSULTAR ."&";
  $campo =  isset($_GET['lstcampo']) ? $_GET['lstcampo'] : null;
	$campovalor = isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null;
	if ( !is_null($campovalor) ) {
	  $campovalor = str_replace(' ','+',$campovalor);
	}
	$opcoesidcampo = array("edital","nome");
	$opcoescampo = array("Edital","Nome");
  $opcoescampopad =  $campo;
  $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
  if (is_null($resultados)) {
    $mensagem_total = "";
  }
  else {
    $mensagem_total = "Total de registro(s) encontrado(s) = " . count($resultados);
  }
	if (count($resultados) > 0) {
    $mensagem_total = "Total de registro(s) encontrado(s) = " . $_SESSION["TOTAL_REGISTRO"];
  	foreach ($resultados as $inscrito) {
	  	$codigo[] = $inscrito->getChavePrimaria();
		  $candidato[] = $inscrito->getNome();
		  $edital[] = $inscrito->getEdital();
		  $links_recibo[] = "gerarecibo.php?codigo=" . $inscrito->getChavePrimaria();
		  $links_editar[] = "cadinscrito.php?operacao=" . Constantes::EDITAR . "&" . "codigo=" . $inscrito->getChavePrimaria();
		  $links_excluir[] = $_SERVER['PHP_SELF'] . "?operacao=" . Constantes::EXCLUIR . "&" . "codigo=" . $inscrito->getChavePrimaria()."&lstcampo=$campo&edtpesquisa=$campovalor&pagina=$pagina";
	  }
	}
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("candidato", $candidato);
	$smarty->assign("edital", $edital);
	$smarty->assign("opcoesidcampo", $opcoesidcampo);
	$smarty->assign("opcoescampo", $opcoescampo);
	$smarty->assign("opcoescampopad", $opcoescampopad);
	$smarty->assign("campovalor", str_replace('+', ' ', $campovalor));
	$smarty->assign("links_recibo", $links_recibo);
	$smarty->assign("links_editar", $links_editar);
	$smarty->assign("links_excluir", $links_excluir);
	$smarty->assign("link_consultar", $link_consultar);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->assign("pages", $pages);
	$smarty->assign("mensagem_total", $mensagem_total);
	$smarty->display("adminscrito.tpl");
}

function montaPaginacao(InscritoHelper $inscritohelper, DAOBanco $banco, $mensagem, $campo, $campovalor, $pagina) {
  $resultados = array();
	$total_registro = 0;
	$pages = null;
	if (strcasecmp($campo, "nome") == 0) {
		$sql = "SELECT CC.IDCONCURSO, CC.IDPESSOA, P.NOME, C.EDITAL FROM CONCURSOSXCANDIDATOS CC INNER JOIN PESSOAS P
		        ON (CC.IDPESSOA = P.ID) INNER JOIN CONCURSOS C ON (CC.IDCONCURSO = C.ID) WHERE P.NOME LIKE '%$campovalor%' ORDER BY P.NOME;";
		try {
		  $resultados = $inscritohelper->consultar($banco, null, null, null, $sql);
		}
		catch (Exception $e) {
		  $mensagem = "N&atilde;o foi poss&iacute;vel consultar o(s) inscrito(s)" . ". Erro: " . $e->getMessage();
		}
    if ($resultados > 0) {
      $total_registro = count($resultados);
      $_SESSION["TOTAL_REGISTRO"] = $total_registro;
	  }
  	if ($total_registro > 0) {
  	  $pag = new Paginacao();
  	  $pag->setPor_Pagina(10);
      $sql = "SELECT FIRST <por_pagina> SKIP <skip> CC.IDCONCURSO, CC.IDPESSOA, P.NOME, C.EDITAL FROM CONCURSOSXCANDIDATOS CC INNER JOIN PESSOAS P
  		        ON (CC.IDPESSOA = P.ID) INNER JOIN CONCURSOS C ON (CC.IDCONCURSO = C.ID) WHERE P.NOME LIKE '%$campovalor%' ORDER BY P.NOME;";
      $pag->__start($banco, $sql, $pagina, $total_registro, $inscritohelper);
      $pag->setEstilo("2");
      $pag->setUrlAdicional("operacao=".Constantes::CONSULTAR."&lstcampo=$campo&edtpesquisa=".urlencode($campovalor));  //Define a url adicional passada por parâmetro via url opcional;
      $resultados = $pag->getResult();
      if ($total_registro > $pag->getNporPg()) {
     	  $pages = $pag->getAnterior("paginacao_on","paginacao_off").$pag->getPaginas("paginacao_paginas").$pag->getProximo("paginacao_on","paginacao_off");
     	}
    }
	}
	else if (strcasecmp($campo, "edital") == 0) {
		$sql = "SELECT CC.IDCONCURSO, CC.IDPESSOA, P.NOME, C.EDITAL FROM CONCURSOSXCANDIDATOS CC INNER JOIN PESSOAS P
  	       ON (CC.IDPESSOA = P.ID) INNER JOIN CONCURSOS C ON (CC.IDCONCURSO = C.ID) WHERE C.EDITAL LIKE '%$campovalor%' ORDER BY P.NOME;";
		try {
		  $resultados = $inscritohelper->consultar($banco, null, null, null, $sql);
		}
		catch (Exception $e) {
		  $mensagem = "N&atilde;o foi poss&iacute;vel consultar o(s) inscrito(s)" . ". Erro: " . $e->getMessage();
		}
    if ($resultados > 0) {
      $total_registro = count($resultados);
      $_SESSION["TOTAL_REGISTRO"] = $total_registro;
	  }
  	if ($total_registro > 0) {
  	  $pag = new Paginacao();
  	  $pag->setPor_Pagina(10);
      $sql = "SELECT FIRST <por_pagina> SKIP <skip> CC.IDCONCURSO, CC.IDPESSOA, P.NOME, C.EDITAL FROM CONCURSOSXCANDIDATOS CC INNER JOIN PESSOAS P
  	         ON (CC.IDPESSOA = P.ID) INNER JOIN CONCURSOS C ON (CC.IDCONCURSO = C.ID) WHERE C.EDITAL LIKE '%$campovalor%' ORDER BY P.NOME;";
      $pag->__start($banco, $sql, $pagina, $total_registro, $inscritohelper);
      $pag->setEstilo("2");
      $pag->setUrlAdicional("operacao=".Constantes::CONSULTAR."&lstcampo=$campo&edtpesquisa=".urlencode($campovalor));  //Define a url adicional passada por parâmetro via url opcional;
      $resultados = $pag->getResult();
      if ($total_registro > $pag->getNporPg()) {
     	  $pages = $pag->getAnterior("paginacao_on","paginacao_off").$pag->getPaginas("paginacao_paginas").$pag->getProximo("paginacao_on","paginacao_off");
     	}
    }

  }
	mostraTemplate($inscritohelper, $banco, $mensagem, $resultados, $pages);
}

?>
