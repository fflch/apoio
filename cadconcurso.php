<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');
ini_set('ibase.dateformat','%d/%m/%Y');
if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$concursohelper = new ConcursoHelper();
	operacao($concursohelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(ConcursoHelper $concursohelper, DAOBanco $banco) {
	$codigo = 0;
	$operacao = "";
	$partial = false;
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
	if ( $codigo > 0 && strcasecmp($operacao, Constantes::EDITAR) <> 0 ) {
	  $operacao = Constantes::EDITAR;
 	  $partial = true;
	}
	$salvar = isset($_POST['salvar']) ? $_POST['salvar'] : null;
	date_default_timezone_set("America/Sao_Paulo");
	$resultados = array();
	$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $codigo));
	if (strcasecmp($operacao, Constantes::EDITAR) == 0 && !is_null($salvar)) {
 		try {
	    $camposValores = populaCampos();
	    $concursohelper->alterar($banco, $camposValores, $filtro);
	    $mensagem = "Registro: " . $codigo . " alterado com sucesso";
    }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel alterar o registro: " . $codigo . ". Erro: " . $e->getMessage();
	  }
	  try {
	    $resultados = $concursohelper->consultar($banco, null, $filtro);
	  }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro alterado" . ". Erro: " . $e->getMessage();
	  }
	  mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao, $partial = true );
  }
	else if (strcasecmp($operacao, Constantes::INSERIR) == 0 && !is_null($salvar)) {
    try {
      $codigo = geraID();
	    $camposValores = populaCampos($codigo, $operacao);
	    $concursohelper->incluir($banco, $camposValores);
	    $mensagem = "Registro inclu&iacute;do com sucesso";
    }
    catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel incluir o registro" . ". Erro: " . $e->getMessage();
	  }
	  try {
     	$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $codigo));
      $resultados = $concursohelper->consultar($banco, null, $filtro);
      $operacao = Constantes::EDITAR;
	  }
    catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel consultar o concurso inserido." . ". Erro: " . $e->getMessage();
	  }

	  mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao, $partial = true);
	}
	else if (strcasecmp($operacao, Constantes::EDITAR) == 0) {
   	try {
			$mensagem = null;
			$resultados = $concursohelper->consultar($banco, null, $filtro);
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro" . ". Erro: " . $e->getMessage();
		}
		mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao, $partial);
	}
	else if (strcasecmp($operacao, Constantes::INSERIR) == 0) {
		mostraTemplate($banco, $resultados, null, $codigo, $operacao, $partial);
	}
}

function populaCampos($codigo = null, $operacao = null) {
  $inicioprova = null;
  $terminoprova = null;
	$camposValores = array();
  if (!is_null($codigo)) {
	  $camposValores['id'] = $codigo;
	}
	$camposValores['inicio'] = str_replace("/",".", isset($_POST['edtinicio']) ? $_POST['edtinicio'] : $_GET['edtinicio']);
	$camposValores['termino'] = str_replace("/", ".", isset($_POST['edtermino']) ? $_POST['edtermino'] : $_GET['edtermino']);
	$camposValores['titularidade'] = isset($_POST['edtitularidade']) ? $_POST['edtitularidade'] : $_GET['edtitularidade'];
	$camposValores['descricao'] = isset($_POST['edtdescricao']) ? $_POST['edtdescricao'] : $_GET['edtdescricao'];
	$camposValores['area'] = isset($_POST['lstarea']) ? $_POST['lstarea'] : $_GET['lstarea'];
	$camposValores['disciplina'] = isset($_POST['edtdisciplina']) ? $_POST['edtdisciplina'] : $_GET['edtdisciplina'];
	$camposValores['edital'] = isset($_POST['edtedital']) ? $_POST['edtedital'] : $_GET['edtedital'];
	$camposValores['datapublicacao'] = str_replace("/",".", isset($_POST['edtdtpublicacao']) ? $_POST['edtdtpublicacao'] : $_GET['edtdtpublicacao']);
	if ( strcasecmp($operacao, Constantes::INSERIR) <> 0 ) {
    $inicioprova  = str_replace("/",".", isset($_POST['edtinicioprova']) ? $_POST['edtinicioprova'] : $_GET['edtinicioprova']);
    $terminoprova = str_replace("/",".", isset($_POST['edterminoprova']) ? $_POST['edterminoprova'] : $_GET['edterminoprova']);
    if ( $inicioprova <> "" and $terminoprova <> "" ) {
      $camposValores['inicioprova'] = $inicioprova;
      $camposValores['terminoprova'] = $terminoprova;
      $camposValores['status'] = 'C';
    }
	}
	$camposValores['processo'] = isset($_POST['edtprocesso']) ? $_POST['edtprocesso'] : $_GET['edtprocesso'];
	$camposValores['livro'] = isset($_POST['edtlivro']) ? $_POST['edtlivro'] : $_GET['edtlivro'];
	$camposValores['iddepartamento'] = isset($_POST['lstdepartamento']) ? $_POST['lstdepartamento'] : $_GET['lstdepartamento'];
  $camposValores['qtdefflch'] = isset($_POST['lstqtdefflch']) ? $_POST['lstqtdefflch'] : $_GET['lstqtdefflch'];
  $camposValores['qtdefora'] = isset($_POST['lstqtdefora']) ? $_POST['lstqtdefora'] : $_GET['lstqtdefora'];
	$camposValores['observacao'] = isset($_POST['edtobservacao']) ? $_POST['edtobservacao'] : $_GET['edtobservacao'];
	if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
   	$userlogado = $_SESSION[Constantes::OBJETO_USUARIO];
	}
	$camposValores['idusuario'] = isset($userlogado) ? $userlogado->getID() : null;
	return $camposValores;
}

function geraID() {
  if (isset($_SESSION[BANCO_SESSAO])) {
    $banco = $_SESSION[BANCO_SESSAO];
    if ($banco->abreConexao() == true) {
			return ibase_gen_id("GERA_CONCURSOS_ID",1);
			$banco->fechaConexao();
		}
		else {
		  return false;
		}
  }
}


function mostraTemplate(DAOBanco $banco, $resultados, $mensagem = null, $codigo = null, $operacao = null, $partial = true) {
  $inicio = null;
  $termino = null;
  $titularidade = null;
  $descricao = null;
  $areapad = null;
  $disciplina = null;
  $edital = null;
  $datapublicacao = null;
  $inicioprova = null;
  $terminoprova = null;
  $processo = null;
  $livro = null;
  $depto_id = null;
  $observacao = null;
  $status = null;
  $certame = isset($_GET['certame']) ? $_GET['certame'] : 'false';
  $opcoesidfflch = array("1","2","3","4","5");
  $opcoesfflch = array("1","2","3","4","5");
  $qtdefflch = 2;
  $opcoesidfora = array("1","2","3","4","5");
  $opcoesfora = array("1","2","3","4","5");
  $qtdefora = 3;

  if (count($resultados) > 0) {
    foreach($resultados as $concurso) {
      $inicio = $concurso->getInicio();
      $termino = $concurso->getTermino();
      $titularidade = $concurso->getTitularidade();
      $descricao = $concurso->getDescricao();
      $areapad = $concurso->getArea();
      $disciplina = $concurso->getDisciplina();
      $edital = $concurso->getEdital();
      $datapublicacao = $concurso->getDataPublicacao();
      $inicioprova = $concurso->getInicioProva();
      $terminoprova = $concurso->getTerminoProva();
      $processo = $concurso->getProcesso();
      $livro = $concurso->getLivro();
      $depto_id = $concurso->getIDepartamento();
      $qtdefflch = $concurso->getQtdeFFLCH();
      $qtdefora = $concurso->getQtdeExterno();
      $observacao = $concurso->getObservacao();
      $status = $concurso->getStatus();
    }
  }
  $departamentos = array();
  $idepto = array();
  $sigla = array();
  try {
    $deptohelper = new DeptoHelper();
    $departamentos = $deptohelper->consultar($banco,null, null, array('sigla'));
  }
  catch(Exception $e){
    $mensagem = "N&atilde;o foi poss&iacute;vel consultar os departamentos" . ". Erro: " . $e->getMessage();
  }
  $idepto[] = "";
  $sigla[] = "Selecione o Depto.";
  if (count($departamentos) > 0 ) {
    foreach($departamentos as $deptos) {
      $idepto[] = $deptos->getID();
      $sigla[] = $deptos->getSigla();
    }
  }

  $areas = array();
  $opcoesarea[] = "Escolha um Depto.";
  if (strcasecmp($operacao, Constantes::EDITAR) == 0) {
    try {
    	$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("iddepto" => $depto_id));
      $areahelper = new AreaHelper();
      $areas = $areahelper->consultar($banco, array('area'), $filtro);
    }
    catch(Exception $e) {
      $mensagem = "N&atilde;o foi poss&iacute;vel consultar as &aacute;reas do departamento" . ". Erro: " . $e->getMessage();
    }
    if (count($areas) > 0 ) {
      foreach($areas as $area) {
        $opcoesarea[] = $area->getArea();
      }
    }
  }

	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
  $smarty->assign("inicio", $inicio);
  $smarty->assign("termino", $termino);
  $smarty->assign("titularidade", $titularidade);
  $smarty->assign("descricao", $descricao);
  $smarty->assign("disciplina", $disciplina);
  $smarty->assign("edital", $edital);
  $smarty->assign("datapublicacao", $datapublicacao);
  $smarty->assign("inicioprova", $inicioprova);
  $smarty->assign("terminoprova", $terminoprova);
  $smarty->assign("processo", $processo);
  $smarty->assign("livro", $livro);
  $smarty->assign("opcoesdeptopad", $depto_id);
  $smarty->assign("observacao", $observacao);
	$smarty->assign("opcoesidepto", $idepto);
	$smarty->assign("opcoesigla", $sigla);

	$smarty->assign("opcoesarea", $opcoesarea);
  $smarty->assign("opcoesareapad", $areapad);

	$smarty->assign("opcoesidfflch", $opcoesidfflch);
	$smarty->assign("opcoesfflch", $opcoesfflch);
	$smarty->assign("opcoesfflchpad", $qtdefflch);
	$smarty->assign("opcoesidfora", $opcoesidfora);
	$smarty->assign("opcoesfora", $opcoesfora);
	$smarty->assign("opcoesforapad", $qtdefora);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("operacao", $operacao);
	$smarty->assign("status", $status);
	$smarty->assign("certame", $certame);
	if (strcasecmp($operacao, Constantes::EDITAR) == 0 && strcasecmp($partial, true) == 0 ) {
	  $smarty->display("pconcurso.tpl");
	}
	else {
  	$smarty->display("cadconcurso.tpl");
 	}
}
?>
