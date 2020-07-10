<?php
require_once ('confconexao.inc.php');
if (file_exists('classes/Loader.class.php')) {
  require_once ('classes/Loader.class.php');
}
elseif  (file_exists('../classes/Loader.class.php')) {
  require_once ('../classes/Loader.class.php');
}

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION[BANCO_SESSAO])) {
	$fabrica = new SimpleFactoryDAOBanco();
	$banco = $fabrica->criaInstanciaBanco(PRODUTO_BANCO_DE_DADOS, HOST_BANCO, LOGIN_BANCO, SENHA_BANCO, NOME_BANCO);
	$_SESSION[BANCO_SESSAO] = $banco;
}
?>
