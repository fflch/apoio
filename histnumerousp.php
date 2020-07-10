<?php
header("Content-Type: text/html;charset=ISO-8859-1",true);
require_once ('classes/Loader.class.php');
require_once ('includes/retornasmarty.inc.php');
require_once ('includes/confconexao.inc.php');
require_once ('includes/retornaconexao.inc.php');
ini_set('ibase.dateformat','%d/%m/%Y');
if (isset($_SESSION[Constantes::OBJETO_USUARIO])) {
	$banco = $_SESSION[BANCO_SESSAO];
    $pessoahelper = new PessoaHelper();
	operacao($pessoahelper, $banco);
}
else {
	header("location:expirou.php");
}

function operacao(PessoaHelper $pessoahelper, DAOBanco $banco) {
	$operacao = "";
	$codigo = 0;
	if (isset($_GET['operacao'])) {
		$operacao = $_GET['operacao'];
	}
	else if (isset($_POST['operacao'])) {
		$operacao = $_POST['operacao'];
	}
	if (strcasecmp($operacao, Constantes::CONSULTAR) == 0) {
		 $campovalor = isset($_GET['edtpesquisa']) ? $_GET['edtpesquisa'] : null;
		 if (!is_null($campovalor)) {
			 $filtro = new FiltroSQL(FiltroSQL::CONECTOR_E, FiltroSQL::OPERADOR_IGUAL, array("nusp" => "$campovalor"));
			 $resultados = array();
			 try {
				 $resultados = $pessoahelper->consultar($banco, array("id, nome"), $filtro);
		   }
			 catch (Exception $e) {
				 $mensagem = "N&atilde;o foi poss&iacute;vel consultar a pessoa " . ". Erro: " . $e->getMessage();
			 }
			 mostraTemplate($banco, $mensagem = null, $resultados);
		 }
    }
    else {
		 mostraTemplate($banco, $mensagem = null, $resultados = null);
	}
}

function mostraTemplate(DAOBanco $banco, $mensagem, $resultados) {
	$idpessoa = array();
	$nome = "";
	$id_titular = array();
	$cargo = array();
	$sigla = array();
	$pertence = array();
	$inicio = array();
	$termino = array();
	$total_titular = "";
	$id_suplente = array();
	$cargo_titular = array();
	$nome_titular = array();
	$sigla_suplente = array();
	$pertence_suplente = array();
	$inicio_suplente = array();
	$termino_suplente = array();
	$total_suplente = "";
	$cor_linha = array('#f5f6fc','#FFFFFF');
	$link_consultar = "histnumerousp.php?operacao=" . Constantes::CONSULTAR ."&";
	if ( !is_null($resultados) ) {
		foreach ($resultados as $pessoa) {
			$idpessoa[] = $pessoa->getID();
			$nome = $pessoa->getNome();
		}
		if ( count($idpessoa) > 1 ){
		    $mensagem = "Erro no cadastro da pessoa! Cadastrada " . count($idpessoa) . " vezes.";
	    }
		elseif ( count($idpessoa) == 1 ) {
			try {
			   $sql = "SELECT CT.ID, C.CARGO, D.SIGLA, CT.PERTENCE, CT.INICIO, CT.TERMINO
                       FROM COMPOSICOESTITULARES CT INNER JOIN CARGOS C
                       ON (CT.IDCARGO = C.ID) INNER JOIN DEPARTAMENTOS D
                       ON (CT.IDDEPARTAMENTO = D.ID) WHERE CT.ATIVO = 'I' AND CT.IDPESSOA = '$idpessoa[0]' ORDER BY CT.ID;";
					   //echo $sql;
			   $resultado_titular = $banco->consultar($sql);
			   $total_titular = "Total de registros como titular = " . count($resultado_titular);
			}
			catch (Exception $e) {
			   $mensagem = "N&atilde;o foi poss&iacute;vel consultar registros da composi&ccedil;&atilde;o de titulares" . ". Erro: " . $e->getMessage();
			}
			if ( count($resultado_titular) > 0 ) {
				foreach ($resultado_titular as $titular) {
			    	foreach ($titular as $campo => $valor) {
			        	if ( strcasecmp($campo, "id") == 0 ) {
			  	        	$id_titular[] = $valor;
			        	}
						if ( strcasecmp($campo, "cargo") == 0 ) {
							$cargo[] = $valor;
						}
						if ( strcasecmp($campo, "sigla") == 0 ) {
							$sigla[] = $valor;
						}
						if ( strcasecmp($campo, "pertence") == 0 ) {
							$pertence[] = descricao_pertence($valor);
						}
						if ( strcasecmp($campo, "inicio") == 0 ) {
							$inicio[] = $valor;
						}
						if ( strcasecmp($campo, "termino") == 0 ) {
							$termino[] = $valor;
						}
		    		}
				}
			}
			try {
		        $sql = "SELECT CS.ID, C.CARGO, P.NOME, D.SIGLA, CS.PERTENCE, CS.INICIO, CS.TERMINO
                        FROM COMPOSICOESSUPLENTES CS INNER JOIN COMPOSICOESTITULARES CT
                        ON (CS.IDCOMPOSICAOTITULAR = CT.ID) INNER JOIN DEPARTAMENTOS D
                        ON (CS.IDDEPARTAMENTO = D.ID) INNER JOIN CARGOS C
                        ON (CT.IDCARGO = C.ID) INNER JOIN PESSOAS P
                        ON (CT.IDPESSOA = P.ID)
                        WHERE CS.ATIVO = 'I' AND CS.IDPESSOA = '$idpessoa[0]' ORDER BY CS.ID;";
				$resultado_suplente = $banco->consultar($sql);
				$total_suplente = "Total de registros como suplente = " . count($resultado_suplente);
			}
			catch (Exception $e) {
                $mensagem = "N&atilde;o foi poss&iacute;vel consultar registros da composi&ccedil;&atilde;o de suplentes" . ". Erro: " . $e->getMessage();
			}
            if ( count($resultado_suplente) > 0 ) {
				foreach ($resultado_suplente as $suplente) {
					foreach ($suplente as $campo => $valor) {
						if ( strcasecmp($campo, "id") == 0 ) {
							$id_suplente[] = $valor;
						}
						if ( strcasecmp($campo, "cargo") == 0 ) {
							$cargo_titular[] = $valor;
						}
						if ( strcasecmp($campo, "nome") == 0 ) {
							$nome_titular[] = $valor;
						}
						if ( strcasecmp($campo, "sigla") == 0 ) {
							$sigla_suplente[] = $valor;
						}
						if ( strcasecmp($campo, "pertence") == 0 ) {
							$pertence_suplente[] = descricao_pertence($valor);
						}
						if ( strcasecmp($campo, "inicio") == 0 ) {
							$inicio_suplente[] = $valor;
						}
						if ( strcasecmp($campo, "termino") == 0 ) {
							$termino_suplente[] = $valor;
						}
					}
				}
			}
	 	}
		else {
	 		$mensagem = "N&atilde;o foi encontrado registro com o N&uacute;mero USP indicado.";
	 	}
	}
	$smarty = retornaSmarty();
	$smarty->assign("mensagem", $mensagem);
	$smarty->assign("id_titular", $id_titular);
	$smarty->assign("nome", $nome);
	$smarty->assign("cargo", $cargo);
	$smarty->assign("sigla", $sigla);
	$smarty->assign("pertence", $pertence);
	$smarty->assign("inicio", $inicio);
	$smarty->assign("termino", $termino);
	$smarty->assign("total_titular", $total_titular);
	$smarty->assign("id_suplente", $id_suplente);
	$smarty->assign("cargo_titular", $cargo_titular);
	$smarty->assign("nome_titular", $nome_titular);
	$smarty->assign("sigla_suplente", $sigla_suplente);
	$smarty->assign("pertence_suplente", $pertence_suplente);
	$smarty->assign("inicio_suplente", $inicio_suplente);
	$smarty->assign("termino_suplente", $termino_suplente);
	$smarty->assign("total_suplente", $total_suplente);
	$smarty->assign("link_consultar", $link_consultar);
	$smarty->assign("cor_linha", $cor_linha);
	$smarty->display("histnumerousp.tpl");
}

function descricao_pertence($valor) {
	if ( $valor == "con" ) {
 	   return "Congrega&ccedil;&atilde;o";
    }
    else {
 	   return "CTA";
    }
}
?>
