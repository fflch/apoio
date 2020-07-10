<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$concursohelper = new ConcursoHelper();
	operacao($concursohelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(ConcursoHelper $concursohelper, DAOBanco $banco) {
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
			$concursohelper->excluir($banco, $filtro);
			$mensagem = "Registro: " . $codigo . " exclu&iacute;do com sucesso.";
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel excluir o registro: " . $codigo . ". Erro: " . $e->getMessage();
		}
		$campo = isset($_GET['lstcampo']) ? $_GET['lstcampo'] : null;
    if (strcasecmp($campo, 'status_certame') == 0)	{
  		$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("status" => "C"));
    }
    else if (strcasecmp($campo, 'descricao') == 0)	{
      $campovalor = isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null;
  		$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_CONTEM, array("descricao" => "%$campovalor%"));
    }
    try {
      $resultados = $concursohelper->consultar($banco, null, $filtro);
    }
    catch (Exception $e) {
      $mensagem = "N&atilde;o foi poss&iacute;vel consultar o concurso: " . $codigo . ". Erro: " . $e->getMessage();
    }
		mostraTemplate($concursohelper, $banco, $mensagem, $resultados, $campo);
	}
	else if (strcasecmp($operacao, Constantes::CONSULTAR) == 0) {
		 $campo =  isset($_GET['lstcampo']) ? $_GET['lstcampo'] : null;
		 $campovalor = isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null;
		 if (strcasecmp($campo, "edital") == 0) {
                         $sql = "SELECT * FROM concursos WHERE edital LIKE '%$campovalor%'";
			 $resultados = array();
			 try {
				 $resultados = $concursohelper->consultar($banco, null, null, null, $sql);
		   }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar o concurso " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($concursohelper, $banco, $mensagem = null, $resultados, $campo);
		 }
     else if (strcasecmp($campo, "status_certame") == 0) {
			 $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("status" => "C"));
			 $resultados = array();
			 try {
				 $resultados = $concursohelper->consultar($banco, null, $filtro);
		   }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar o concurso " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($concursohelper, $banco, $mensagem = null, $resultados, $campo);
		 }
	 }
	 else {
  	 $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("status" => "C"));
		 $resultados = array();
		 try {
		   $resultados = $concursohelper->consultar($banco, null, $filtro);
		 }
		 catch (Exception $e) {
		   $mensagem = "N&atilde;o foi poss&iacute;vel consultar o concurso " . ". Erro: " . $e->getMessage();
		 }
		 mostraTemplate($concursohelper, $banco, $mensagem = null, $resultados);
	 }
}

function mostraTemplate(ConcursoHelper $concursohelper, DAOBanco $banco, $mensagem = null, $resultados = null, $campo = 'status_certame') {
	$codigo    = array();
  $edital = array();
	$links_excluir = array();
	$links_editar = array();
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$link_consultar = "admconcurso.php?operacao=" . Constantes::CONSULTAR ."&";
	$opcoesidcampo = array("edital","status_certame");
	$opcoescampo = array("Edital","Todos em Certame");
	$opcoescampopad = $campo;
	$campovalor = isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null;
	if (is_null($resultados)) {
 	  $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("status" => "C"));
		try {
			$resultados = $concursohelper->consultar($banco, null, $filtro);
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel consultar registros de concursos" . ". Erro: " . $e->getMessage();
		}
	}
  foreach($resultados as $concurso) {
    $codigo[] = $concurso->getID();
    $edital[] = $concurso->getEdital();
	  $links_editar[] = "cadconcurso.php?operacao=" . Constantes::EDITAR . "&" . "codigo=" . $concurso->getId() . "&" . "certame=true";
  	$links_excluir[] = $_SERVER['PHP_SELF'] . "?operacao=" . Constantes::EXCLUIR . "&" . "codigo=" . $concurso->getId() . "&" . "lstcampo=" . $campo . "&" . "edtpesquisa=" . $campovalor;
	}
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("edital", $edital);
	$smarty->assign("opcoesidcampo", $opcoesidcampo);
	$smarty->assign("opcoescampo", $opcoescampo);
	$smarty->assign("opcoescampopad", $opcoescampopad);
	$smarty->assign("links_editar", $links_editar);
	$smarty->assign("links_excluir", $links_excluir);
	$smarty->assign("link_consultar", $link_consultar);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->display("admconcurso.tpl");
}
?>
