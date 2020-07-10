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
	$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : $_POST['codigo'];
	$tipo   = isset($_GET['tipo']) ? $_GET['tipo'] : $_POST['tipo'];
	if (!is_null($codigo) && !is_null($tipo)){
	  if (strcasecmp($tipo, "I") == 0) {
      $sql = "SELECT CE.ID, CE.IDCONCURSO, CE.TIPO, CE.ITEM, CE.PAUTA, CC.IDPESSOA, PE.NOME,
              CO.DESCRICAO, CO.AREA, CO.EDITAL, CO.DATAPUBLICACAO
              FROM CEDULAS CE INNER JOIN CONCURSOSXCANDIDATOS CC ON(CE.IDCONCURSO = CC.IDCONCURSO)
              INNER JOIN PESSOAS PE ON(CC.IDPESSOA = PE.ID) INNER JOIN CONCURSOS CO ON (CE.IDCONCURSO = CO.ID)
              WHERE CE.ID=$codigo;";

    }
    elseif (strcasecmp($tipo, "B") == 0) {
       $sql = "SELECT CE.ID, CE.IDCONCURSO, CE.TIPO, CE.ITEM, CE.PAUTA, COM.IDPESSOA, PE.NOME, PE.INSTITUICAO, T.TITULO, COM.ORIGEM,
              CON.QTDEFFLCH, CON.QTDEFORA, CON.DESCRICAO, CON.AREA, CON.EDITAL, CON.DATAPUBLICACAO
              FROM CEDULAS CE INNER JOIN COMISSOES COM ON(CE.IDCONCURSO = COM.IDCONCURSO)
              INNER JOIN PESSOAS PE ON(COM.IDPESSOA = PE.ID) INNER JOIN CONCURSOS CON ON(CE.IDCONCURSO = CON.ID)
              INNER JOIN TITULACOESPESSOAS TP ON(TP.IDPESSOA = PE.ID) INNER JOIN TITULACOES T ON(T.ID = TP.IDTITULACAO)
              WHERE CE.ID=$codigo AND TP.ATIVO='S' ORDER BY COM.DHINCLUSAO;";
    }
    elseif (strcasecmp($tipo, "R") == 0) {
       $sql = "SELECT CE.ID, CE.IDCONCURSO, CE.TIPO, CE.ITEM, CE.PAUTA, R.ID as IDPERGUNTA, R.PERGUNTA,
              CO.DESCRICAO, CO.AREA, CO.EDITAL, CO.DATAPUBLICACAO FROM CEDULAS CE
              INNER JOIN RELATORIOS R ON(CE.ID = R.IDCEDULA) INNER JOIN CONCURSOS CO ON (CE.IDCONCURSO = CO.ID)
              WHERE CE.ID=$codigo;";
    }
    elseif (strcasecmp($tipo, "O") == 0) {
       $sql = "SELECT CE.ID, CE.TIPO, CE.ITEM, CE.DESCRICAOOUTRO,CE.PAUTA, O.ID as IDPERGUNTA, O.PERGUNTA FROM CEDULAS CE
              INNER JOIN OUTROS O ON(CE.ID = O.IDCEDULA) WHERE CE.ID=$codigo;";
    }
    try{
      $resultados = $cedulahelper->consultar($banco, null, null, null, $sql);
    }
    catch(Exception $e) {
      $mensagem = "N&atilde;o foi poss&iacute;vel fazer a consulta das c&eacute;dulas! Erro: " . $e->getMessage();
    }
  	mostraTemplate($cedulahelper, $banco, $mensagem = null, $resultados);
	}
	else {
	 mostraTemplate($cedulahelper, $banco);
	}
}

function mostraTemplate(CedulaHelper $cedulahelper, DAOBanco $banco, $mensagem = null, $resultados = null) {
  $id_cedula = null;
  $id_concurso = null;
  $tipo = null;
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
      $tipo = $cedula->getTipo();
      $item = $cedula->getItem();
      $pauta = $cedula->getPauta();
      $descricao = $cedula->getDescricao() . " , &aacute;rea de " . $cedula->getArea() . ", conforme edital " . $cedula->getEdital() . ", publicado em " . $cedula->getDataPublicacao() . ".";
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
      elseif (strcasecmp($tipo, "O") == 0 || strcasecmp($tipo, "R") == 0) {
        $id_pergunta = $cedula->getIDPergunta();
        $pergunta = $cedula->getPergunta();
        if (strcasecmp($tipo, "O") == 0) {
          $descricao = $cedula->getDescricaoOutro(); 
        }
      }
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
	$smarty->display("cedulamodal.tpl");
}

?>
