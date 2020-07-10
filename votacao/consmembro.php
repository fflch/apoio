<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('../classes/Loader.class.php');
//require_once ('includes/confconexao.inc.php');
require_once ('../includes/retornaconexao.inc.php');
ini_set('ibase.dateformat','%d/%m/%Y');
if (!isset($_SESSION)) {
  session_start();
}
#sleep(5);
$mensagem = null;
if (isset($_POST['rdtipo'])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$nusp = $_POST['edtnusp'];
	$tipo  = $_POST['rdtipo'];
	$pertence = $_POST["pertence"];
	$data = date("d.m.Y");
	$id = null;
  $presencahelper = new PresencaHelper();
  $resultados = null;
  $presenca = null;
  if ( strcasecmp($tipo,"T") == 0 ) {
	  $idcargo = $_POST['lstcargo'];
    $sql = "SELECT IDPESSOA FROM PRESENCAS PR INNER JOIN PESSOAS PE ON(PR.IDPESSOA = PE.ID)
            WHERE PE.NUSP='$nusp' AND PR.DATA='$data' AND PR.PERTENCE='$pertence'";
    try {
      $presenca = $presencahelper->consultar($banco, null, null, null, $sql);
    }
    catch(Exception $e)  {
	    $mensagem = "N&atilde;o foi poss&iacute;vel consultar a presen&ccedil;a! " . ". Erro: " . $e->getMessage();
    }
    if (count($presenca) > 0 ) {
      $mensagem = "Voc&ecirc; j&aacute; votou! N&atilde;o pode votar novamente.";
    }
    else {
      $sql = "SELECT IDSUPLENTE FROM PRESENCAS PR INNER JOIN COMPOSICOESSUPLENTES CS
              ON(PR.IDSUPLENTE = CS.ID) INNER JOIN COMPOSICOESTITULARES CT
              ON(CT.ID = CS.IDCOMPOSICAOTITULAR) INNER JOIN PESSOAS PE
              ON(CT.IDPESSOA = PE.ID)
              WHERE PE.NUSP='$nusp' AND CT.IDCARGO='$idcargo' AND PR.DATA='$data' AND PR.PERTENCE='$pertence'";
      try {
        $presenca = $presencahelper->consultar($banco, null, null, null, $sql);
      }
      catch(Exception $e)  {
	      $mensagem = "N&atilde;o foi poss&iacute;vel consultar a presen&ccedil;a! " . ". Erro: " . $e->getMessage();
      }
      if (count($presenca) > 0 ) {
        $mensagem = "Suplente j&aacute; votou! Voc&ecirc; n&atilde;o pode votar.";
      }
      else {
   	    $sql = "SELECT CT.ID, CT.IDPESSOA, CT.INICIO, CT.TERMINO FROM COMPOSICOESTITULARES CT INNER JOIN PESSOAS P
	              ON(CT.IDPESSOA = P.ID) WHERE CT.ATIVO='A' AND CT.IDCARGO='$idcargo' AND P.NUSP='$nusp' AND CT.PERTENCE='$pertence';";
  	    $titularhelper = new TitularHelper();
	      try {
 	        $resultados = $titularhelper->consultar($banco, null, null, null, $sql);
	      }
	      catch (Exception $e) {
	        $mensagem = "N&atilde;o foi poss&iacute;vel consultar o titular" . ". Erro: " . $e->getMessage();
	      }
	      if (count($resultados) > 0) {
          foreach($resultados as $titular) {
  	        $id = $titular->getID();
  	        $idpessoa = $titular->getIDPessoa();
  	        $inicio = $titular->getInicio();
	          $termino = $titular->getTermino();
	        }
	      }
	      else {
	        $mensagem = "Dados inv&aacute;lidos, n&uacute;mero USP ou Cargo n&atilde;o confere!";
	      }
      }
    }
	}
	else if ( strcasecmp($tipo,"S") == 0 ) {
    $idtitular = $_POST['lstitular'];
    $sql = "SELECT IDPESSOA FROM PRESENCAS PR INNER JOIN PESSOAS PE ON(PR.IDPESSOA = PE.ID)
            WHERE PE.NUSP='$nusp' AND PR.DATA='$data' AND PR.PERTENCE='$pertence'";
    try {
      $presenca = $presencahelper->consultar($banco, null, null, null, $sql);
    }
    catch(Exception $e)  {
	    $mensagem = "N&atilde;o foi poss&iacute;vel consultar a presen&ccedil;a! " . ". Erro: " . $e->getMessage();
    }
    if (count($presenca) > 0 ) {
      $mensagem = "Voc&ecirc; j&aacute; votou! N&atilde;o pode votar novamente.";
    }
    else {
      $sql = "SELECT IDTITULAR FROM PRESENCAS PR INNER JOIN COMPOSICOESTITULARES CT
              ON(PR.IDTITULAR = CT.ID) INNER JOIN COMPOSICOESSUPLENTES CS
              ON(CT.ID = CS.IDCOMPOSICAOTITULAR) INNER JOIN PESSOAS PE
              ON(CS.IDPESSOA = PE.ID)
              WHERE PE.NUSP='$nusp' AND CT.ID='$idtitular' AND PR.DATA='$data' AND PR.PERTENCE='$pertence'";
      try {
        $presenca = $presencahelper->consultar($banco, null, null, null, $sql);
      }
      catch(Exception $e)  {
	      $mensagem = "N&atilde;o foi poss&iacute;vel consultar a presen&ccedil;a! " . ". Erro: " . $e->getMessage();
      }
      if (count($presenca) > 0 ) {
        $mensagem = "Titular j&aacute; votou! Voc&ecirc; n&atilde;o pode votar.";
      }
      else {
        $sql = "SELECT CS.ID, CS.IDPESSOA, CS.INICIO, CS.TERMINO FROM COMPOSICOESSUPLENTES CS INNER JOIN PESSOAS P
                ON(CS.IDPESSOA = P.ID) WHERE CS.ATIVO='A' AND CS.IDCOMPOSICAOTITULAR='$idtitular' AND P.NUSP='$nusp'";
        $suplentehelper = new SuplenteHelper();
	      try {
 	        $resultados = $suplentehelper->consultar($banco, null, null, null, $sql);
	      }
	      catch (Exception $e) {
	        $mensagem = "N&atilde;o foi poss&iacute;vel consultar o suplente" . ". Erro: " . $e->getMessage();
	      }
	      if (count($resultados) > 0) {
	        foreach($resultados as $suplente) {
	          $id = $suplente->getID();
	          $idpessoa = $suplente->getIDPessoa();
	          $inicio = $suplente->getInicio();
	          $termino = $suplente->getTermino();
	        }
	      }
	      else {
	        echo "Dados inv&aacute;lidos, n&uacute;mero USP ou Titular n&atilde;o confere!";
	      }
      }
    }
  }
  if (count($resultados) > 0 ) {
    $datainicio = substr($inicio,6,4)."/".substr($inicio,3,2)."/".substr($inicio,0,2);
    $datafim =  substr($termino,6,4)."/".substr($termino,3,2)."/".substr($termino,0,2);
    $mensagem = comparaDatas($datainicio,$datafim);
    if ($mensagem == false) {
      $camposValores = array() ;
      $camposValores['idpessoa'] = $idpessoa;
      $camposValores['pertence'] = $pertence;
      $camposValores['data'] = $data;
      if ( strcasecmp($tipo,"T") == 0 ) {
        $camposValores['idtitular'] = $id;
      }
      elseif ( strcasecmp($tipo,"S") == 0 ) {
        $camposValores['idsuplente'] = $id;
      }

# tirar o comentário abaixo quando a votação entrar em produção

      $presencahelper->incluir($banco, $camposValores);
    }
  }
  echo $mensagem;
}

function comparaDatas($datainicio,$datafim) {
  $datainicio = strtotime($datainicio);
  $datafim = strtotime($datafim);
  $data = strtotime(date("Y/m/d"));
  if ($datainicio > $data) {
    return "Mandato inv&aacute;lido, n&atilde;o iniciou!";
  }
  elseif ($datafim < $data) {
    return "Mandato inv&aacute;lido, terminou!";
  }
  else {
    return false;
  }
}

?>
