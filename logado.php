<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');
if(!isset($_SESSION)){
  session_start();
}

$banco = $_SESSION[BANCO_SESSAO];
$usuario = null;

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$usuario = $_SESSION[Constantes::OBJETO_USUARIO];
}
$smarty = retornaSmarty();
if (!is_null($usuario)) {
	$smarty->assign("login", $usuario->getLogin());
	$smarty->assign("nivel", $usuario->getNivel());
}
$smarty->display("logado.tpl");

?>
