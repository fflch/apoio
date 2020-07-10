<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
	$pessoahelper = new PessoaHelper();
	operacao($pessoahelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(PessoaHelper $pessoahelper, DAOBanco $banco) {
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
	    $pessoahelper->alterar($banco, $camposValores, $filtro);
	    $mensagem = "Registro: " . $codigo . " alterado com sucesso";
    }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel alterar o registro: " . $codigo . ". Erro: " . $e->getMessage();
	  }
	  try {
	    $resultados = $pessoahelper->consultar($banco, null, $filtro);
	  }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro alterado" . ". Erro: " . $e->getMessage();
	  }
	  mostraTemplate($banco, $resultados, $mensagem, $codigo, $operacao, $partial = true);
  }
	else if (strcasecmp($operacao, Constantes::INSERIR) == 0 && !is_null($salvar)) {
    try {
      $codigo = geraID();
	    $camposValores = populaCampos($codigo);
	    $pessoahelper->incluir($banco, $camposValores);
	    $mensagem = "Registro inclu&iacute;do com sucesso";
    }
    catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel incluir o registro" . ". Erro: " . $e->getMessage();
	  }
	  try {
     	$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("id" => $codigo));
      $resultados = $pessoahelper->consultar($banco, null, $filtro);
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
			$resultados = $pessoahelper->consultar($banco, null, $filtro);
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

function populaCampos($codigo = null) {
	$camposValores = array();
	if (!is_null($codigo)) {
	  $camposValores['id'] = $codigo;
	}
  $camposValores['nusp'] = isset($_POST['edtnusp']) ? $_POST['edtnusp'] : $_GET['edtnusp'];
  $camposValores['nome'] = isset($_POST['edtnome']) ? $_POST['edtnome'] : $_GET['edtnome'];
  $camposValores['endereco'] = isset($_POST['edtendereco']) ? $_POST['edtendereco'] : $_GET['edtendereco'];
  $camposValores['complemento'] = isset($_POST['edtcomplemento']) ? $_POST['edtcomplemento'] : $_GET['edtcomplemento'];
  $camposValores['cidade'] = isset($_POST['edtcidade']) ? $_POST['edtcidade'] : $_GET['edtcidade'];
  $camposValores['estado'] = isset($_POST['lstestado']) ? $_POST['lstestado'] : $_GET['lstestado'];
  $camposValores['cep'] = isset($_POST['edtcep']) ? $_POST['edtcep'] : $_GET['edtcep'];
#  $camposValores['instituicao'] = isset($_POST['edtinstituicao']) ? $_POST['edtinstituicao'] : $_GET['edtinstituicao'];
  $camposValores['instituicao'] = isset($_POST['lstinstituicao']) ? $_POST['lstinstituicao'] : $_GET['lstinstituicao'];
  $camposValores['rg'] = isset($_POST['edtrg']) ? $_POST['edtrg'] : $_GET['edtrg'];
  $camposValores['pispasep'] = isset($_POST['edtpispasep']) ? $_POST['edtpispasep'] : $_GET['edtpispasep'];
  $camposValores['cpf'] = isset($_POST['edtcpf']) ? $_POST['edtcpf'] : $_GET['edtcpf'];
  $camposValores['passaporte'] = isset($_POST['edtpassaporte']) ? $_POST['edtpassaporte'] : $_GET['edtpassaporte'];
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
			return ibase_gen_id("GERA_PESSOAS_ID",1);
			$banco->fechaConexao();
		}
		else {
		  return false;
		}
  }
}

function mostraTemplate(DAOBanco $banco, $resultados, $mensagem = null, $codigo = null, $operacao = null, $partial = false) {
	$nusp = "";
	$idepartamento = "";
	$depto = "";
	$nome = "";
	$endereco = "";
	$complemento = "";
	$cidade = "";
	$opcoesestadopad = "";
	$cep = "";
	$instituicaopad = "";
	$rg = "";
	$pispasep = "";
	$cpf = "";
	$passaporte = "";
	$observacao = "";
	$datamodificacao = "";
	if (count($resultados) > 0) {
		foreach ($resultados as $pessoas) {
			$nusp = $pessoas->getNusp();
			$idepartamento = $pessoas->getIDepartamento();
			$nome = $pessoas->getNome();
			$endereco =  $pessoas->getEndereco();
			$complemento = $pessoas->getComplemento();
			$cidade = $pessoas->getCidade();
			$opcoesestadopad = $pessoas->getEstado();
			$cep = $pessoas->getCEP();
			$instituicaopad =  $pessoas->getInstituicao();
			$rg = $pessoas->getRG();
			$pispasep = $pessoas->getPispasep();
			$cpf = $pessoas->getCPF();
			$passaporte = $pessoas->getPassaport();
			$observacao = $pessoas->getObservacao();
		//	$datamodificacao = "&Uacute;ltima altera&ccedil;&atilde;o ".strftime("%d/%m/%Y %H:%M:%S", strtotime($pessoas->getDHModificacao()));
			$datamodificacao = "&Uacute;ltima altera&ccedil;&atilde;o ".$pessoas->getDHModificacao();
		}
	}

  $instituicoes = array();
  $siglainstituicao = array();
  if ($instituicaopad <> "") {
    $siglainstituicao[] = $instituicaopad;
  }
  else {
    $siglainstituicao[] = "Selecione a Institui&ccedil;&atilde;o";
  }
  try {
    $instituicaohelper = new InstituicaoHelper();
    $instituicoes = $instituicaohelper->consultar($banco, null, null, array('SIGLA'));
  }
  catch(Exception $e){
    $mensagem = "N&atilde;o foi poss&iacute;vel consultar as institui&ccedil;&otilde;es" . ". Erro: " . $e->getMessage();
  }
  if (count($instituicoes) > 0 ) {
    foreach($instituicoes as $instituicao) {
      $siglainstituicao[] = $instituicao->getSigla();
    }
  }  
  if ($opcoesestadopad == "") {
    $opcoesestadopad = "SP";
  }
  $opcoesestados = array("AL","AM","BA","CE","DF","GO","ES","MA","MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN","RS","RO","RR","SP","SC","SE","TO"); 
  
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("nusp", $nusp);
	$smarty->assign("idepartamento", $idepartamento);
	$smarty->assign("nome", $nome);
	$smarty->assign("endereco", $endereco);
	$smarty->assign("complemento", $complemento);
	$smarty->assign("cidade", $cidade);
	$smarty->assign("opcoesestados", $opcoesestados);
	$smarty->assign("opcoesestadopad", $opcoesestadopad);
	$smarty->assign("cep", $cep);
	$smarty->assign("opcoesinstituicao", $siglainstituicao);
	$smarty->assign("opcoesinstituicaopad", $instituicaopad);
	$smarty->assign("rg", $rg);
	$smarty->assign("pispasep", $pispasep);
	$smarty->assign("cpf", $cpf);
	$smarty->assign("passaporte", $passaporte);
	$smarty->assign("observacao", $observacao);
	$smarty->assign("codigo", $codigo);
	$smarty->assign("operacao", $operacao);
	$smarty->assign("datamodificacao", $datamodificacao);	
	if (strcasecmp($operacao, Constantes::EDITAR) == 0 && strcasecmp($partial, true) == 0 ) {
	  $smarty->display("ppessoa.tpl");
	}
	else {
  	$smarty->display("cadpessoa.tpl");
 	}
}
?>
