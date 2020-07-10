<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');
ini_set('ibase.dateformat','%d/%m/%Y');
if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$cedulahelper = new CedulaHelper();
	operacao($cedulahelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(CedulaHelper $cedulahelper, DAOBanco $banco) {
	$operacao = "";
	$mensagem = "";
	if (isset($_GET['operacao'])) {
		$operacao = $_GET['operacao'];
	}
	else if (isset($_POST['operacao'])) {
		$operacao = $_POST['operacao'];
	}
	$salvar = isset($_POST['salvar']) ? $_POST['salvar'] : null;
	date_default_timezone_set("America/Sao_Paulo");
  $hoje = date("d.m.Y");
  if (strcasecmp($operacao, Constantes::CONSULTAR) == 0) {
	  $campovalor = str_replace("/",".", isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : $hoje);
	 	$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("data" => $campovalor));
	  $resultados = array();
		  try {
			  $resultados = $cedulahelper->consultar($banco, array("id","pertence","data","item","pauta","votacao"), $filtro, array("pertence","data"));
			}
			catch (Exception $e) {
			  $mensagem = "N&atilde;o foi poss&iacute;vel consultar as c&eacute;dulas da data selecionada" . ". Erro: " . $e->getMessage();
			}
      $total_registro = count($resultados);
      if ($total_registro > 0 ) {
        $mensagem = " Total de $total_registro registro encontrado(s).";
        $operacao = 'editar';
      }
      else {
        $mensagem = " Nenhum registro encontrado para a data selecionada.";
      }
      mostraTemplate($mensagem, $operacao, $resultados, $datapesquisada = $campovalor);
	 }
   elseif (strcasecmp($operacao, Constantes::EDITAR) == 0 && !is_null($salvar)) {
     $status = isset($_POST['lstvotacao']) ? $_POST['lstvotacao'] : $_GET['lstvotacao'];
     $total_check = isset($_POST['check']) ? $_POST['check'] : null;
     $todos = isset($_POST['todos']) ? $_POST['todos'] : null;
     $datapesquisada = str_replace("/",".", isset($_POST['datapesquisada']) ? $_POST['datapesquisada'] : $_GET['datapesquisada']);
     if ( !is_null($todos) ) {
       $sql = "UPDATE CEDULAS SET VOTACAO = '$status' WHERE DATA = '$datapesquisada'";
       try {
         $cedulahelper->alterar($banco, null, null, $sql);
       }
       catch(Exception $e) {
         $mensagem = "Erro ao alterar a c&eacute;dula! Erro: " . $e->getMessage();
       }
     }
     elseif (count($total_check) > 0 ) {
       foreach($total_check as $idcedula) {
         $sql = "UPDATE CEDULAS SET VOTACAO = '$status'
                 WHERE ID = '$idcedula'";
         try {
           $cedulahelper->alterar($banco, null, null, $sql);
         }
         catch(Exception $e) {
           $mensagem = "Erro ao alterar a c&eacute;dula! Erro: " . $e->getMessage();
         }
       }
     }
     if ( !is_null($datapesquisada) ) {
   	 	 $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("data" => $datapesquisada));
   	   $resultados = array();
		   try {
			   $resultados = $cedulahelper->consultar($banco, array("id","pertence","data","item","pauta","votacao"), $filtro, array("pertence","data"));
			 }
			 catch (Exception $e) {
			   $mensagem = "N&atilde;o foi poss&iacute;vel consultar as c&eacute;dulas da data selecionada" . ". Erro: " . $e->getMessage();
       }
     }
     mostraTemplate($mensagem, $operacao, $resultados, $datapesquisada);
   }
}

function mostraTemplate($mensagem = null, $operacao = null, $resultados = null, $datapesquisada = null) {
	$codigo = array();
  $pertence = array();
 	$data = array();
  $item = array();
	$pauta = array();
	$votacao = array();
  $cor_linha = array('#f5f6fc','#FFFFFF');
  $datapesquisa = str_replace(".","/", $datapesquisada);
  if (!is_null($resultados)) {
	  foreach ($resultados as $cedulas) {
	    $codigo[] = $cedulas->getID();
      if ($cedulas->getPertence() == "con" ) {
        $pertence[] = "Congrega&ccedil;&atilde;o";
      }
      else {
       $pertence[] = "CTA";
      }
	    $data[] = $cedulas->getData();
	    $item[] = $cedulas->getItem();
	    $pauta[] = $cedulas->getPauta();
      if ($cedulas->getVotacao() == "N") {
  	    $votacao[] = "Edi&ccedil;&atilde;o";
	    }
	    elseif ($cedulas->getVotacao() == "V") {
  	    $votacao[] = "Vota&ccedil;&atilde;o";
	    }
 	    else {
	      $votacao[] = "Finalizada";
      }
    }
	}
	$opcoesidvotacao = array("","V","N","F");
	$opcoesvotacao = array("Selecione o status", "Vota&ccedil;&atilde;o", "Edi&ccedil;&atilde;o", "Finalizar");
	$opcoesvotacaopad = isset($_POST['lstvotacao']) ? $_POST['lstvotacao'] : null;
	$smarty = retornaSmarty();
	$smarty->assign("opcoesidvotacao", $opcoesidvotacao);
	$smarty->assign("opcoesvotacao", $opcoesvotacao);
	$smarty->assign("opcoesvotacaopad", $opcoesvotacaopad);
  $smarty->assign("resultados", $resultados);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("pertence", $pertence);
	$smarty->assign("data", $data);
	$smarty->assign("item", $item);
	$smarty->assign("pauta", $pauta);
  $smarty->assign("votacao", $votacao);
 	$smarty->assign("cor_linha", $cor_linha);
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("operacao", $operacao);
  $smarty->assign("datapesquisa", $datapesquisa);
	$smarty->display("habilitar.tpl");
}
?>
