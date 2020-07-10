<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('../classes/Loader.class.php');
require_once ('../includes/retornasmarty.inc.php');
require_once ('../includes/confconexao.inc.php');
#require_once ('includes/retornaconexao.inc.php');
#if (!isset($_SESSION)) {
#  session_start();
#}

$fabrica = new SimpleFactoryDAOBanco();
$banco = $fabrica->criaInstanciaBanco(PRODUTO_BANCO_DE_DADOS, HOST_BANCO, LOGIN_BANCO, SENHA_BANCO, NOME_BANCO);

#$banco = $_SESSION[BANCO_SESSAO];
$cedulahelper = new CedulaHelper();
$cargohelper = new CargoHelper();
$titularhelper = new TitularHelper();
$result_cedula = array();
$pertence = null;
$id_cargo = array();
$cargos = array();
$result_cargo = array();
$id_titular = array();
$titulares = array();
$result_titular = array();
$mensagem = null;
$vot_mensagem = null;
$data = date("d.m.Y");
$id_cargo[] = "";
$cargos[] = "Selecione a Condi&ccedil;&atilde;o";
#$id_titular[] = "";
#$titulares[] = "Selecione o Titular";

try {
  $sql = "SELECT FIRST 1 PERTENCE FROM CEDULAS WHERE VOTACAO = 'V' AND DATA='$data';";
  $result_cedula = $cedulahelper->consultar($banco, null, null, null, $sql);
}
catch (Exception $e) {
  $mensagem = "Erro ao consultar a c&eacute;dulas em vota&ccedil;&atilde;o. Erro: " . $e->getMessage();
}
if (count($result_cedula) > 0) {
  foreach($result_cedula as $cedula) {
    $pertence = $cedula->getPertence();
  }
}
else {
  $vot_mensagem = "N&atilde;o h&aacute; c&eacute;dulas cadastradas ou habilitadas para vota&ccedil;&atilde;o!";
}
if (count($pertence) > 0){
  if(strcasecmp($pertence,'cta') == 0) {
    $vot_mensagem = "CTA";
  }
  else {
    $vot_mensagem = "Congrega&ccedil;&atilde;o";
  }
  try {
    $result_cargo = $cargohelper->consultar($banco, array("id","cargo"), null, array("cargo"));
  }
  catch (Exception $e) {
    $mensagem = "Erro ao consultar a condi&ccedil;&atilde;o. Erro: " . $e->getMessage();
  }
  if (count($result_cargo) > 0) {
    foreach ($result_cargo as $cargo) {
      $id_cargo[] = $cargo->getID();
      $cargos[] = $cargo->getCargo();
    }
  }
  try {
    $sql = "SELECT CT.ID, P.NOME, C.CARGO FROM COMPOSICOESTITULARES CT INNER JOIN PESSOAS P
            ON(CT.IDPESSOA = P.ID) INNER JOIN CARGOS C ON(CT.IDCARGO=C.ID) WHERE CT.ATIVO='A' AND CT.PERTENCE='$pertence' ORDER BY C.CARGO, P.NOME" ;
    $result_titular = $titularhelper->consultar($banco, null, null, null, $sql);
  }
  catch (Exception $e) {
    $mensagem = "Erro ao consultar os titulares. Erro: " . $e->getMessage() ;
  }
  if (count($result_titular) > 0) {
    $cargo_atual = null;
    $titulares['Selecione'] = array('' => 'Selecione o Titular');
    foreach ($result_titular as $titular) {
      if ($cargo_atual == $titular->getCargo()) {
        $titulares[$titular->getCargo()] = $titulares[$titular->getCargo()] + array($titular->getID() => $titular->getNome());
      }
      else {
        $titulares[$titular->getCargo()] = array($titular->getID() => $titular->getNome());
        $cargo_atual = $titular->getCargo();
      }
    }
  }
}

$smarty = retornaSmarty();
$smarty->assign("mensagem", $mensagem);
$smarty->assign("vot_mensagem", $vot_mensagem);
$smarty->assign("opcoesidcargo", $id_cargo);
$smarty->assign("opcoescargo", $cargos);
#$smarty->assign("opcoesidtitular", $id_titular);
$smarty->assign("opcoestitular", $titulares);
$smarty->assign("pertence", $pertence);
$smarty->display("index.tpl");
?>
