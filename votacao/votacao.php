<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('../classes/Loader.class.php');
require_once ('../includes/retornasmarty.inc.php');
//require_once ('includes/confconexao.inc.php');
require_once ('../includes/retornaconexao.inc.php');

if (isset($_SESSION[BANCO_SESSAO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$cedulahelper = new CedulaHelper();
  $pessoahelper = new PessoaHelper();
	$mensagem = null;
	$resultados = null;
  $pessoas = null;
	$sql = null;
}
else {
	header("location:expirou.php");
}

if ( isset($_POST['edtnusp']) ) {
unset($_SESSION['idvotante']);
unset($_SESSION['nome']);
$nusp = isset($_POST["edtnusp"]) ? $_POST["edtnusp"] : $_GET["edtnusp"];
$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("nusp" => $nusp));
try {
  //$pessoas = $pessoahelper->consultar($banco, array('id','nome'), $filtro);
  $pessoas = $pessoahelper->consultar($banco, null, $filtro);
}
catch(Exception $e) {
  echo "Erro ao consultar os dados do professor! Erro: " . $e->getMessage();
}
if (count($pessoas) > 0 ) {
  foreach($pessoas as $pessoa) {
    $_SESSION['idvotante'] = $pessoa->getID();
    $_SESSION['nome'] = utf8_encode($pessoa->getNome());
  }
}
$data = date("d.m.Y");
$pertence = isset($_POST["pertence"]) ? $_POST["pertence"] : $_GET["pertence"];
$banco = $_SESSION[BANCO_SESSAO];
unset($_SESSION['TOTAL_CEDULAS']);

$i = 0;
for($x=0; $x<=3; $x++){
  if ($x == 0) {
    $tipo = 'I';
  }
  elseif ($x == 1){
    $tipo = 'B';
  }
  elseif ($x == 2){
    $tipo = 'R';
  }
  else {
    $tipo = 'O';
  }
  $sql = "SELECT ID, TIPO FROM CEDULAS WHERE VOTACAO = 'V' AND DATA='$data' AND PERTENCE='$pertence' AND TIPO='$tipo';";
  try{
    $resultados = $cedulahelper->consultar($banco, null, null, null, $sql);
  }
  catch(Exception $e) {
    $mensagem = "N&atilde;o foi poss&iacute;vel fazer a consulta das c&eacute;dulas! Erro: " . $e->getMessage();
  }

  if (count($resultados) > 0 ) {
    foreach($resultados as $cedulas) {
      $array_cedulas[$i]['ID'] = $cedulas->getID();
      $array_cedulas[$i]['TIPO'] = $cedulas->getTipo();
      $i++;
    }
  }
 }
 $_SESSION['TOTAL_CEDULAS'] = $array_cedulas;
}

if (count($_SESSION['TOTAL_CEDULAS']) > 0) {
  computavoto($cedulahelper, $banco, $sql);
  operacao($cedulahelper, $banco, $mensagem);
}
else {
  if (isset($_POST['votacao'])) {
    computavoto($cedulahelper, $banco, $sql);
  }
  $_SESSION = array();
  session_destroy();
  $smarty = retornaSmarty();
  $smarty->display('fim.tpl');
}

function operacao(CedulaHelper $cedulahelper, DAOBanco $banco, $mensagem) {
  $array_cedulas = $_SESSION['TOTAL_CEDULAS'];
  $id = $array_cedulas[0]['ID'];
  $tipo = $array_cedulas[0]['TIPO'];
  array_shift($array_cedulas);
  $_SESSION['TOTAL_CEDULAS'] = $array_cedulas;
  if (strcasecmp($tipo, "I") == 0) {
    $sql = "SELECT CE.ID, CE.IDCONCURSO, CE.ITEM, CE.PAUTA, CC.IDPESSOA, PE.NOME,
            CO.DESCRICAO, CO.AREA, CO.EDITAL, CO.DATAPUBLICACAO
            FROM CEDULAS CE INNER JOIN CONCURSOSXCANDIDATOS CC ON(CE.IDCONCURSO = CC.IDCONCURSO)
            INNER JOIN PESSOAS PE ON(CC.IDPESSOA = PE.ID) INNER JOIN CONCURSOS CO ON (CE.IDCONCURSO = CO.ID)
            WHERE CE.ID='$id';";
    }
  elseif (strcasecmp($tipo, "B") == 0) {
    $sql = "SELECT CE.ID, CE.IDCONCURSO, CE.ITEM, CE.PAUTA, COM.IDPESSOA, PE.NOME, PE.INSTITUICAO, T.TITULO, COM.ORIGEM,
            CON.QTDEFFLCH, CON.QTDEFORA, CON.DESCRICAO, CON.AREA, CON.EDITAL, CON.DATAPUBLICACAO
            FROM CEDULAS CE INNER JOIN COMISSOES COM ON(CE.IDCONCURSO = COM.IDCONCURSO)
            INNER JOIN PESSOAS PE ON(COM.IDPESSOA = PE.ID) INNER JOIN CONCURSOS CON ON(CE.IDCONCURSO = CON.ID)
            INNER JOIN TITULACOESPESSOAS TP ON(TP.IDPESSOA = PE.ID) INNER JOIN TITULACOES T ON(T.ID = TP.IDTITULACAO)
            WHERE CE.ID='$id' AND TP.ATIVO='S' ORDER BY COM.DHINCLUSAO;";
  }
  elseif (strcasecmp($tipo, "R") == 0) {
    $sql = "SELECT CE.ID, CE.IDCONCURSO, CE.ITEM, CE.PAUTA, R.ID as IDPERGUNTA, R.PERGUNTA,
            CO.DESCRICAO, CO.AREA, CO.EDITAL, CO.DATAPUBLICACAO FROM CEDULAS CE
            INNER JOIN RELATORIOS R ON(CE.ID = R.IDCEDULA) INNER JOIN CONCURSOS CO ON (CE.IDCONCURSO = CO.ID)
            WHERE CE.ID='$id';";
  }
  elseif (strcasecmp($tipo, "O") == 0) {
    $sql = "SELECT CE.ID, CE.DESCRICAOOUTRO, CE.ITEM, CE.PAUTA, O.ID as IDPERGUNTA, O.PERGUNTA
            FROM CEDULAS CE INNER JOIN OUTROS O ON(CE.ID = O.IDCEDULA) WHERE CE.ID='$id';";
  }
  try{
    $resultados = $cedulahelper->consultar($banco, null, null, null, $sql);
  }
  catch(Exception $e) {
    $mensagem = "N&atilde;o foi poss&iacute;vel fazer a consulta das c&eacute;dulas! Erro: " . $e->getMessage();
  }
  mostraTemplate($mensagem, $resultados, $tipo);
}

function computavoto(CedulaHelper $cedulahelper, $banco, $sql) {
  $votacao = isset($_POST['votacao']) ? $_POST['votacao'] : null;
  if (strcasecmp($votacao,"yes") == 0 ) {
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
    $branco = isset($_POST['branco']) ? $_POST['branco'] : null;
    $nulo = isset($_POST['nulo']) ? $_POST['nulo'] : null;
    $id_cedula = isset($_POST['id_cedula']) ? $_POST['id_cedula'] : 0;
    $id_concurso = isset($_POST['id_concurso']) ? $_POST['id_concurso'] : 0;
    if (strcasecmp($branco,"yes") == 0 ) {
      $sql = "UPDATE CEDULAS SET BRANCO = BRANCO + 1 WHERE id = $id_cedula;";
      votobranconulo($cedulahelper, $banco, $sql, $id_cedula, $voto = 'branco');
    }
    elseif (strcasecmp($nulo,"yes") == 0 ) {
      $sql = "UPDATE CEDULAS SET NULO = NULO + 1 WHERE id = $id_cedula;";
      votobranconulo($cedulahelper, $banco, $sql, $id_cedula, $voto = 'nulo');
    }
    else {
      voto($banco, $tipo, $id_cedula, $id_concurso);
    }
  }
}

function votobranconulo(CedulaHelper $cedulahelper, $banco, $sql, $id_cedula, $voto) {
  $votocedulahelper = new VotoCedulaHelper();
  try {
    $cedulahelper->alterar($banco, null, null, $sql);
  }
  catch(Exception $e) {
    echo "Erro ao computar voto! Erro: " . $e->getMessage();
  }
  try {
    $votocedulahelper->incluir($banco, array("idcedula" => $id_cedula, "idvotante" => $_SESSION['idvotante'], "nome" => $_SESSION['nome'], "voto" => $voto));
  }
  catch(Exception $e) {
    echo "Erro ao inserir ao dados do votante! C&eacute;dula id=$id_cedula : Erro: " . $e->getMessage();
  }
}

function voto($banco, $tipo, $id_cedula, $id_concurso) {
   if ( strcasecmp($tipo,"I") == 0 ) {
     $total_rdtipo = isset($_POST['rdtipo']) ? $_POST['rdtipo'] : null;
     if (count($total_rdtipo) > 0 ) {
       $inscricaohelper = new InscritoHelper();
       $votoinscricaohelper = new VotoInscricaoHelper();
       foreach($total_rdtipo as $valor) {
         $valores = explode('-', $valor);
         $sql = "UPDATE CONCURSOSXCANDIDATOS SET $valores[0] = $valores[0] + 1
                 WHERE IDCONCURSO = $id_concurso AND IDPESSOA = $valores[1]";
         try {
           $inscricaohelper->alterar($banco, null, null, $sql);
         }
         catch(Exception $e) {
           echo "Erro ao computar voto! Erro: " . $e->getMessage();
         }

         try {
           $votoinscricaohelper->incluir($banco, array("idcedula" => $id_cedula, "idvotante" => $_SESSION['idvotante'], "nome" => $_SESSION['nome'], "idcandidato" => $valores[1], "voto" => $valores[0]));
         }
         catch(Exception $e) {
           echo "Erro ao inserir ao dados do votante! C&eacute;dula Inscri&ccedil;&atilde;o id= $id_cedula : Erro: " . $e->getMessage();
         }

       }
     }
   }
   elseif ( strcasecmp($tipo, "B") == 0 ) {
     $total_check = isset($_POST['check']) ? $_POST['check'] : null;
     $qtde_fflch = isset($_POST['qtde_fflch']) ? $_POST['qtde_fflch'] : 0;
     $qtde_fora = isset($_POST['qtde_fora']) ? $_POST['qtde_fora'] : 0;
     $total = $qtde_fflch + $qtde_fora;
     $comissaohelper = new ComissaoHelper();
     $votobancahelper = new VotoBancaHelper();
     $votobancaexternahelper = new VotoBancaExternaHelper();
     if (count($total_check) > 0 ) {
       foreach($total_check as $idpessoa) {
         $sql = "UPDATE COMISSOES SET VOTO = VOTO + 1
                 WHERE IDCONCURSO = $id_concurso AND IDPESSOA = $idpessoa";
         try {
           $comissaohelper->alterar($banco, null, null, $sql);
         }
         catch(Exception $e) {
           echo "Erro ao computar voto! Erro: " . $e->getMessage();
         }
         try {
           $votobancahelper->incluir($banco, array("idcedula" => $id_cedula, "idvotante" => $_SESSION['idvotante'], "nome" => $_SESSION['nome'], "idpessoacomissao" => $idpessoa));
         }
         catch(Exception $e) {
           echo "Erro ao inserir ao dados do votante! C&eacute;dula Banca id=$id_cedula : Erro: " . $e->getMessage();
         }
       }
     }
     if ( count($total_check) < $total ) {
       $nomefflch = isset($_POST['nomefflch']) ? $_POST['nomefflch'] : null;
       $nomefora = isset($_POST['nomefora']) ? $_POST['nomefora'] : null;
       $comissaoexternahelper = new ComissaoExternaHelper();
       $camposValores = array();
       $camposValores['idconcurso'] = $id_concurso;
       $camposValores['idcedula'] = $id_cedula;
       if (!is_null($nomefflch)) {
         foreach($nomefflch as $nome) {
           if ($nome <> '') {
             $idpessoacomissao = GeraIdComissaoExterna($banco);
             $camposValores['nome'] = $nome;
             $camposValores['origem'] = "FFLCH";
             $camposValores['id'] = $idpessoacomissao;
             try {
               $comissaoexternahelper->incluir($banco, $camposValores);
             }
             catch(Exception $e) {
               echo "Erro ao computar voto! Erro: " . $e->getMessage();
             }
             InsereVotoBancaDigitado($banco, $votobancaexternahelper, $id_cedula, $idpessoacomissao);
           }
         }
       }
       if (!is_null($nomefora)) {
         foreach($nomefora as $nome) {
           if ($nome <> '') {
             $idpessoacomissao = GeraIdComissaoExterna($banco);
             $camposValores['nome'] = $nome;
             $camposValores['origem'] = "EXTERNO";
             $camposValores['id'] = $idpessoacomissao;
             try {
               $comissaoexternahelper->incluir($banco, $camposValores);
             }
             catch(Exception $e) {
               echo "Erro ao computar voto! Erro: " . $e->getMessage();
             }
             InsereVotoBancaDigitado($banco, $votobancaexternahelper, $id_cedula, $idpessoacomissao);
           }
         }
       }
     }
   }
   elseif ( strcasecmp($tipo, "R") == 0 ) {
     $id_pergunta = isset($_POST['id_pergunta']) ? $_POST['id_pergunta'] : null;
     $resposta = isset($_POST['rdpergunta']) ? $_POST['rdpergunta'] : null;
     if (!is_null($id_pergunta) && !is_null($resposta)){
       $relatoriohelper = new RelatorioHelper();
       $votorelatoriohelper = new VotoRelatorioHelper();
       $sql = "UPDATE RELATORIOS SET $resposta = $resposta + 1
               WHERE ID = $id_pergunta AND IDCEDULA = $id_cedula";
       try {
         $relatoriohelper->alterar($banco, null, null, $sql);
       }
       catch(Exception $e) {
         echo "Erro ao computar voto! Erro: " . $e->getMessage();
       }
       try {
         $votorelatoriohelper->incluir($banco, array("idcedula" => $id_cedula,"idvotante" => $_SESSION['idvotante'],"nome" => $_SESSION['nome'], "voto" => $resposta));
       }
       catch(Exception $e) {
         echo "Erro ao inserir ao dados do votante! C&eacute;dula Outro id=$id_cedula : Erro: " . $e->getMessage();
       }
     }
   }
   elseif ( strcasecmp($tipo, "O") == 0 ) {
     $id_pergunta = isset($_POST['id_pergunta']) ? $_POST['id_pergunta'] : null;
     $resposta = isset($_POST['rdpergunta']) ? $_POST['rdpergunta'] : null;
     if (!is_null($id_pergunta) && !is_null($resposta)){
       $outrohelper = new OutroHelper();
       $votooutrohelper = new VotoOutroHelper();
       $sql = "UPDATE OUTROS SET $resposta = $resposta + 1
               WHERE ID = $id_pergunta AND IDCEDULA = $id_cedula";
       try {
         $outrohelper->alterar($banco, null, null, $sql);
       }
       catch(Exception $e) {
         echo "Erro ao computar voto! Erro: " . $e->getMessage();
       }
       try {
         $votooutrohelper->incluir($banco, array("idcedula" => $id_cedula,"idvotante" => $_SESSION['idvotante'],"nome" => $_SESSION['nome'], "voto" => $resposta));
       }
       catch(Exception $e) {
         echo "Erro ao inserir ao dados do votante! C&eacute;dula Outro id=$id_cedula : Erro: " . $e->getMessage();
       }
     }
   }
}

function InsereVotoBancaDigitado($banco, VotoBancaExternaHelper $votobancaexternahelper, $id_cedula, $idpessoacomissao) {
  try {
    $votobancaexternahelper->incluir($banco, array("idcedula" => $id_cedula, "idvotante" => $_SESSION['idvotante'], "nome" => $_SESSION['nome'], "idpessoacomissao" => $idpessoacomissao));
  }
  catch(Exception $e) {
    echo "Erro ao inserir ao dados do votante! C&eacute;dula Banca Digitada id=$id_cedula : Erro: " . $e->getMessage();
  }
}

function GeraIdComissaoExterna($banco) {
  if ($banco->abreConexao() == true) {
    $id = ibase_gen_id("GERA_COMISSOESEXTERNAS_ID", 1);
    $banco->fechaConexao();
  }
  return	$id;
}

function mostraTemplate($mensagem = null, $resultados = null, $tipo) {
  $target = $_SERVER['PHP_SELF'];
  $id_cedula = null;
  $id_concurso = null;
  $item = null;
  $descricao = null;
  $qtde_fflch = 0;
  $qtde_fora = 0;
  $qtde_inscrito = 0;
  $id_pessoa = array();
  $nome = array();
  $instituicao = array();
  $titulo = array();
  $origem = array();
  $id_pergunta = null;
  $pergunta = null;
 	$cor_linha = array('#f5f6fc','#FFFFFF');
  if (count($resultados) > 0 ) {
    $qtde_inscrito = count($resultados);
    foreach($resultados as $cedula) {
      $id_cedula = $cedula->getID();
      $id_concurso = $cedula->getIDConcurso();
      $item = $cedula->getItem();
      $pauta = $cedula->getPauta();
      if (strcasecmp($tipo, "O") == 0 ) {
        $id_pergunta = $cedula->getIDPergunta();
        $pergunta = $cedula->getPergunta();
        $descricao = $cedula->getDescricaoOutro();
      }
      else { 
        $descricao = $cedula->getDescricao() . " , &aacute;rea de " . $cedula->getArea() . ", conforme edital " . $cedula->getEdital() . ", publicado em " . $cedula->getDataPublicacao() . ".";
      }
      if (strcasecmp($tipo, "I") == 0 ) {
        $id_pessoa[] = $cedula->getIDPessoa();
        $nome[] = $cedula->getNome();
      }
      elseif (strcasecmp($tipo, "B") == 0 ) {
        $qtde_fflch = $cedula->getQtdeFFLCH();
        $qtde_fora = $cedula->getQtdeFORA();
        $id_pessoa[] = $cedula->getIDPessoa();
        $nome[] = $cedula->getNome();
        $instituicao[] = $cedula->getInstituicao();
        $titulo[] = $cedula->getTitulo();
        $origem[] = $cedula->getOrigem();
      }
      elseif (strcasecmp($tipo, "R") == 0 ) {
        $id_pergunta = $cedula->getIDPergunta();
        $pergunta = $cedula->getPergunta();
      }
/*      elseif (strcasecmp($tipo, "O") == 0 ) {
        $id_pergunta = $cedula->getIDPergunta();
        $pergunta = $cedula->getPergunta();
      }*/
    }
  }
  $smarty = retornaSmarty();
  $smarty->assign("mensagem", $mensagem);
  $smarty->assign("id_cedula", $id_cedula);
  $smarty->assign("id_concurso", $id_concurso);
  $smarty->assign("item", $item);
  $smarty->assign("pauta", $pauta);
  $smarty->assign("descricao", $descricao);
  $smarty->assign("id_pessoa", $id_pessoa);
  $smarty->assign("nome", $nome);
  $smarty->assign("instituicao", $instituicao);
  $smarty->assign("titulo", $titulo);
  $smarty->assign("qtde_fflch", $qtde_fflch);
  $smarty->assign("qtde_fora", $qtde_fora);
  $smarty->assign("origem", $origem);
  $smarty->assign("qtde_inscrito", $qtde_inscrito);
  $smarty->assign("id_pergunta", $id_pergunta);
  $smarty->assign("pergunta", $pergunta);
  $smarty->assign("cor_linha", $cor_linha);
  $smarty->assign("tipo", $tipo);
  $smarty->assign("votacao", "yes");
  $smarty->assign("target", $target);
  $smarty->display("votacao.tpl");
}
?>
