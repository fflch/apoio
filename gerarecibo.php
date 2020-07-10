<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');

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
	$idconcurso = 0;
	$idpessoa = 0;
	if (isset($_GET['codigo'])) {
		$codigo = $_GET['codigo'];
	}
	else if (isset($_POST['codigo'])) {
		$codigo = $_POST['codigo'];
	}
	if ($codigo <> 0) {
    $ids = explode("-",$codigo);
    $idconcurso = $ids[0];
    $idpessoa = $ids[1];
	}
	$resultados = array();
	$filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("idconcurso" => $idconcurso, "idpessoa" => $idpessoa));
	  try {
  	  $sql = "SELECT C.AREA, C.DISCIPLINA, C.EDITAL, C.DATAPUBLICACAO, C.DESCRICAO, D.SIGLA, P.NOME FROM CONCURSOSXCANDIDATOS CC INNER JOIN CONCURSOS C
              ON(CC.IDCONCURSO = C.ID) INNER JOIN PESSOAS P ON(CC.IDPESSOA = P.ID) INNER JOIN DEPARTAMENTOS D ON (C.IDDEPARTAMENTO = D.ID) 
              WHERE CC.IDCONCURSO = $idconcurso AND CC.IDPESSOA = $idpessoa;";
	    $resultados = $concursohelper->consultar($banco, null, null, null, $sql);
	  }
	  catch (Exception $e) {
	    $mensagem = "N&atilde;o foi poss&iacute;vel consultar o registro alterado" . ". Erro: " . $e->getMessage();
	  }
	  mostraTemplate($banco, $resultados, $mensagem = null, $codigo);
}

function mostraTemplate(DAOBanco $banco, $resultados, $mensagem = null, $codigo = null) {  
  $nome = "";
  $depto = "";
  $area = "";
  $disciplina = "";
  $edital = "";
  $dataedital = "";
  $data = null;
  if (count($resultados) > 0) {
		foreach ($resultados as $concurso) {
			$nome = $concurso->getNome();
			$depto = $concurso->getDepto();
                        $area = $concurso->getArea();
			$disciplina = $concurso->getDisciplina();
			$edital = $concurso->getEdital();
			$dataedital = $concurso->getDataPublicacao();
	  }
	}
  $texto_doutor = "Recebemos de $nome, os materiais abaixo relacionados, referentes a inscri&ccedil;&atilde;o para o provimento de um cargo de Professor ";
  $texto_doutor.= "Doutor, no $depto, &aacute;rea de $area, disciplina de $disciplina, conforme exig&ecirc;ncias do Edital $edital de $dataedital.";
  $texto_titular = "Recebemos de $nome, os materiais abaixo relacionados, referentes a inscri&ccedil;&atilde;o para o provimento de um cargo de Professor ";
  $texto_titular.= "Titular, no $depto, &aacute;rea de $area, disciplina de $disciplina, conforme exig&ecirc;ncias do Edital $edital de $dataedital.";
  $texto_livre = "Recebemos de $nome, os materiais abaixo relacionados, referentes a inscri&ccedil;&atilde;o para a Livre-Doc&ecirc;ncia, ";  
  $texto_livre.= "no $depto, &aacute;rea de $area, disciplina de $disciplina, conforme exig&ecirc;ncias do Edital $edital de $dataedital.";  
  $texto_procseletivo = "Recebemos de $nome, os materiais abaixo relacionados, referentes a inscri&ccedil;&atilde;o para o processo seletivo para a contrata&ccedil;&atilde;o ";
  $texto_procseletivo.= "de um docente por prazo determinado, no $depto, &aacute;rea de $area, disciplina de $disciplina, conforme exig&ecirc;ncias do Edital $edital de $dataedital.";    
  $opcoesidcargo = array($texto_doutor,$texto_titular,$texto_livre,$texto_procseletivo);
  $opcoescargo = array("Professor Doutor","Professor Titular","Livre-Doc&ecirc;ncia","Processo Seletivo");
  $opcoescargopad = "Doutor";

	
  $smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("depto", $depto);
	$smarty->assign("opcoesidcargo", $opcoesidcargo);
	$smarty->assign("opcoescargo", $opcoescargo);	
	$smarty->assign("opcoescargopad", $opcoescargopad);	
	$smarty->assign("texto_doutor", $texto_doutor);
	$smarty->assign("texto_titular", $texto_titular);
	$smarty->assign("texto_livre", $texto_livre);
	$smarty->assign("texto_procseletivo", $texto_procseletivo);		
	$smarty->assign("data", $data);		
	$smarty->display("gerarecibo.tpl");
}
?>
