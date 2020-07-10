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
	$codigo = 0;
	$operacao = "";
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
	$salvar = isset($_POST['salvar']) ? $_POST['salvar'] : null;
	$teste = isset($_POST['teste']) ? $_POST['teste'] : null;
	date_default_timezone_set("America/Sao_Paulo");
	$resultados = array();
	$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $codigo));
	if (strcasecmp($operacao, Constantes::EDITAR) == 0 && !is_null($salvar)) {
          try {
	    $camposValores = populaCampos();
	    $result = $cedulahelper->alterar($banco, $camposValores, $filtro);
	    $mensagem = "Registro: " . $codigo . " alterado com sucesso";
          }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel alterar o registro: " . $codigo . ". Erro: " . $e->getMessage();
	  }
 	  if ($camposValores['tipo'] == 'R' && $result > 0) {
 	    $idpergunta = isset($_POST['idpergunta']) ? $_POST['idpergunta'] : $_GET['idpergunta'];
	    $filtrorelatorio = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $idpergunta));
	    try {
	      $camposValoresRelatorio = array();
	      $camposValoresRelatorio['pergunta'] = isset($_POST['edtpergunta']) ? $_POST['edtpergunta'] : $_GET['edtpergunta'];
	      $camposValoresRelatorio['idusuario'] = $camposValores['idusuario'];
	      $relatoriohelper = new RelatorioHelper();
              $relatoriohelper->alterar($banco, $camposValoresRelatorio, $filtrorelatorio);
	    }
	    catch (Exception $e) {
	      $mensagem = "N&atilde;o foi poss&iacute;vel alterar a Pergunta, Avise o Analista e informe o" . ". Erro: " . $e->getMessage();
	    }
	  }
 	  if ($camposValores['tipo'] == 'O' && $result > 0) {
 	    $idpergunta = isset($_POST['idpergunta']) ? $_POST['idpergunta'] : $_GET['idpergunta'];
	    $filtrooutro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $idpergunta));
	    try {
	      $camposValoresOutro = array();
	      $camposValoresOutro['pergunta'] = isset($_POST['edtpergunta']) ? $_POST['edtpergunta'] : $_GET['edtpergunta'];
	      $camposValoresOutro['idusuario'] = $camposValores['idusuario'];
	      $outrohelper = new OutroHelper();
              $outrohelper->alterar($banco, $camposValoresOutro, $filtrooutro);
	    }
	    catch (Exception $e) {
	      $mensagem = "N&atilde;o foi poss&iacute;vel altera a Perguntar, Avise o Analista e informe o" . ". Erro: " . $e->getMessage();
	    }
	  }
	  try {
	    $resultados = $cedulahelper->consultar($banco, null, $filtro);
	  }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro alterado" . ". Erro: " . $e->getMessage();
	  }
	  mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao);
  }
	else if (strcasecmp($operacao, Constantes::INSERIR) == 0 && !is_null($salvar)) {
    try {
	    $camposValores = populaCampos($operacao, $banco);
	    $result = $cedulahelper->incluir($banco, $camposValores);
	    $mensagem = "Registro inclu&iacute;do com sucesso";
    }
    catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel incluir o registro" . ". Erro: " . $e->getMessage();
	  }
	  if ($camposValores['tipo'] == 'R' && $result > 0) {
	    try {
	      $camposValoresRelatorio = array();
	      $camposValoresRelatorio['idcedula'] = $camposValores['id'];
	      $camposValoresRelatorio['pergunta'] = isset($_POST['edtpergunta']) ? $_POST['edtpergunta'] : $_GET['edtpergunta'];
	      $camposValoresRelatorio['idusuario'] = $camposValores['idusuario'];
	      $relatoriohelper = new RelatorioHelper();
              $relatoriohelper->incluir($banco, $camposValoresRelatorio);
              $mensagem = "Registro inclu&iacute;do com sucesso";
	    }
	    catch (Exception $e) {
	      $mensagem = "N&atilde;o foi poss&iacute;vel incluir a Pergunta, Avise o Analista e informe o" . ". Erro: " . $e->getMessage();
     	      $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $camposValores['id']));
              $cedulahelper->excluir($banco, $filtro);
	    }
	  }
	  if ($camposValores['tipo'] == 'O' && $result > 0) {
	    try {
	      $camposValoresOutro = array();
	      $camposValoresOutro['idcedula'] = $camposValores['id'];
	      $camposValoresOutro['pergunta'] = isset($_POST['edtpergunta']) ? $_POST['edtpergunta'] : $_GET['edtpergunta'];
	      $camposValoresOutro['idusuario'] = $camposValores['idusuario'];
	      $outrohelper = new OutroHelper();
              $outrohelper->incluir($banco, $camposValoresOutro);
              $mensagem = "Registro inclu&iacute;do com sucesso";
	    }
	    catch (Exception $e) {
	      $mensagem = "N&atilde;o foi poss&iacute;vel incluir a Pergunta, Avise o Analista e informe o" . ". Erro: " . $e->getMessage();
     	      $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $camposValores['id']));
              $cedulahelper->excluir($banco, $filtro);
	    }
	  }
	  mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao);
	}
	else if (strcasecmp($operacao, Constantes::EDITAR) == 0) {
   	try {
			$mensagem = null;
			$resultados = $cedulahelper->consultar($banco, null, $filtro);
		}
		catch (Exception $e) {
			$mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro" . ". Erro: " . $e->getMessage();
		}
		mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao);
	}
	else if (strcasecmp($operacao, Constantes::INSERIR) == 0) {
		mostraTemplate($banco, $resultados, null, $codigo, $operacao);
	}
}

function populaCampos($operacao = null, $banco = null) {
	$camposValores = array();
	if (strcasecmp($operacao, Constantes::INSERIR) == 0) {
	  if ($banco->abreConexao() == true) {
			$idcedula = ibase_gen_id("GERA_CEDULAS_ID", 1);
			$banco->fechaConexao();
		}
    $camposValores['id'] = $idcedula;
  }
	$camposValores['tipo'] = isset($_POST['lstipo']) ? $_POST['lstipo'] : $_GET['lstipo'];
        if ($camposValores['tipo'] <> 'O') {
          $camposValores['idconcurso'] = isset($_POST['lstconcurso']) ? $_POST['lstconcurso'] : $_GET['lstconcurso'];
        }
	$camposValores['item'] = isset($_POST['edtitem']) ? $_POST['edtitem'] : $_GET['edtitem'];
	$camposValores['pertence'] = isset($_POST['lstpertence']) ? $_POST['lstpertence'] : $_GET['lstpertence'];
	$camposValores['pauta'] = isset($_POST['edtpauta']) ? $_POST['edtpauta'] : $_GET['edtpauta'];
	$camposValores['data'] = str_replace("/",".", isset($_POST['edtdata']) ? $_POST['edtdata'] : $_GET['edtdata']);
	$camposValores['descricaooutro'] = isset($_POST['edtdescricaoutro']) ? $_POST['edtdescricaoutro'] : $_GET['edtdescricaoutro'];
	if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
   	$userlogado = $_SESSION[Constantes::OBJETO_USUARIO];
	}
	$camposValores['idusuario'] = isset($userlogado) ? $userlogado->getID() : null;
	return $camposValores;
}

function mostraTemplate(DAOBanco $banco, $resultados, $mensagem = null, $codigo = null, $operacao = null) {
  $tipo = null;
  $concurso_id = null;
  $item = null;
  $pertence_id = null;
  $pauta = null;
  $data = null;
  $idpergunta = null;
  $pergunta = null;
  $descricaoutro = null;
	$opcoesidpertence = array(Titular::PERTENCE_CTA,Titular::PERTENCE_CONGREGRACAO);
	$opcoespertence = array("CTA","Congrega&ccedil;&atilde;o");
	$opcoesidtipo = array("","I","B","R","O");
	$opcoestipo = array("Selecione o Tipo","Inscri&ccedil;&atilde;o","Banca","Relatorio","Outro");
  $opcoesidconcurso[] = "";
  $opcoesconcurso[] = "Escolha o Tipo";
  if (count($resultados) > 0 ) {
		foreach ($resultados as $cedula) {
			$concurso_id = $cedula->getIDConcurso();
      $tipo = $cedula->getTipo();
      $item = $cedula->getItem();
      $pertence_id = $cedula->getPertence();
      $pauta = $cedula->getPauta();
      $data = $cedula->getData();
      $descricaoutro = $cedula->getDescricaoOutro();
      if ( $tipo === "R" ){
        $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idcedula" => $codigo));
        try {
          $relatoriohelper = new RelatorioHelper();
          $result = $relatoriohelper->consultar($banco, null, $filtro);
        }
        catch(Exception $e) {
     			$mensagem = "N&atilde;o foi poss&iacute;vel consultar a pergunta" . ". Erro: " . $e->getMessage();
        }
        if (count($result) > 0 ){
          foreach ($result as $relatorio) {
            $idpergunta = $relatorio->getID();
            $pergunta = $relatorio->getPergunta();
          }
        }
      }
      if ( $tipo === "O" ){
        $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idcedula" => $codigo));
        try {
          $outrohelper = new OutroHelper();
          $result = $outrohelper->consultar($banco, null, $filtro);
        }
        catch(Exception $e) {
     			$mensagem = "N&atilde;o foi poss&iacute;vel consultar a pergunta" . ". Erro: " . $e->getMessage();
        }
        if (count($result) > 0 ){
          foreach ($result as $outro) {
            $idpergunta = $outro->getID();
            $pergunta = $outro->getPergunta();
          }
        }
      }
		}
		if (strcasecmp($operacao, Constantes::EDITAR) == 0) {
      $concursos = array();
      if ($tipo == "I" || $tipo == "B" ){
        $status = "A";
      }
      else {
        $status = "C";
      }
    	$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("status" => $status));
      try {
        $concursohelper = new ConcursoHelper();
        $concursos = $concursohelper->consultar($banco,null,$filtro);
      }
      catch(Exception $e){
        $mensagem = "N&atilde;o foi poss&iacute;vel consultar os concursos" . ". Erro: " . $e->getMessage();
      }
      if (count($concursos) > 0 ) {
        foreach($concursos as $concurso) {
          $opcoesidconcurso[] = $concurso->getID();
          $opcoesconcurso[] = $concurso->getEdital();
        }
      }
		}
  }
	$smarty = retornaSmarty();
        $smarty->assign('tipo', $tipo);
	$smarty->assign("opcoesidconcurso", $opcoesidconcurso);
	$smarty->assign("opcoesconcurso", $opcoesconcurso);
	$smarty->assign("opcoesconcursopad", $concurso_id);
        $smarty->assign("item", $item);
        $smarty->assign("opcoesidtipo", $opcoesidtipo);
        $smarty->assign("opcoestipo", $opcoestipo);
        $smarty->assign("opcoestipopad", $tipo);
	$smarty->assign("opcoesidpertence", $opcoesidpertence);
	$smarty->assign("opcoespertence", $opcoespertence);
	$smarty->assign("opcoespertencepad", $pertence_id);
        $smarty->assign("pauta", $pauta);
        $smarty->assign("data", $data);
        $smarty->assign("idpergunta", $idpergunta);
        $smarty->assign("pergunta", $pergunta);
        $smarty->assign("descricaoutro", $descricaoutro);
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("operacao", $operacao);
	$smarty->display("cadcedula.tpl");
}
?>
