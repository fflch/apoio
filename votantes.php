<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$presencahelper = new PresencaHelper();
	operacao($presencahelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(PresencaHelper $presencahelper, DAOBanco $banco) {
	$operacao = "";
	$codigo = 0;
	if (isset($_GET['operacao'])) {
		$operacao = $_GET['operacao'];
	}
	else if (isset($_POST['operacao'])) {
		$operacao = $_POST['operacao'];
	}
  if (strcasecmp($operacao, Constantes::CONSULTAR) == 0) {
		 $pertence =  isset($_GET['lstpertence']) ? $_GET['lstpertence'] : 'cta';
		 $data = str_replace("/",".", isset($_GET['edtdata']) ? $_GET['edtdata'] : date("d.m.Y"));
		 if (!is_null($pertence)) {
       $sql = "SELECT NOME FROM PRESENCAS INNER JOIN PESSOAS P ON(IDPESSOA=P.ID)
               WHERE PERTENCE = '$pertence' AND DATA='$data' ORDER BY NOME;";
			 $resultados = array();
			 try {
				 $resultados = $presencahelper->consultar($banco, null, null, null, $sql);
		   }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar quem votou " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($presencahelper, $banco, $mensagem = null, $resultados);
		 }
	 }
	 else {
		 mostraTemplate($presencahelper, $banco);
	 }
}

function mostraTemplate(PresencaHelper $presencahelper, DAOBanco $banco, $mensagem = null, $resultados = null) {
	$nome  = array();
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$link_consultar = "votantes.php?operacao=" . Constantes::CONSULTAR ."&";
	$opcoesidpertence = array('cta', 'con');
	$opcoespertence = array('CTA', 'Congrega&ccedil;&atilde;o');
	$opcoespertencepad = isset($_GET['lstpertence']) ? $_GET['lstpertence'] : 'cta';
	$data = isset($_GET['edtdata']) ? $_GET['edtdata'] : null;
  if (count($resultados) > 0) {
  	foreach ($resultados as $presenca) {
		  $nome[] = $presenca->getNome();
    }
  }
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("nome", $nome);
	$smarty->assign("link_consultar", $link_consultar);
	$smarty->assign('opcoesidpertence', $opcoesidpertence);
	$smarty->assign('opcoespertence', $opcoespertence);
	$smarty->assign('opcoespertencepad', $opcoespertencepad);
	$smarty->assign('data', $data);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->display("votantes.tpl");
}
?>
