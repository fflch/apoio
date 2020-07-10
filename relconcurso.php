<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$smarty = retornaSmarty();
	$smarty->assign("link_consultar","concurso.php?");
        $smarty->assign("mensagem", "");
	$smarty->display("relconcurso.tpl");
}
else {
	header("location:expirou.php");
}

?>
