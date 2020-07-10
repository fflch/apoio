<?php

require_once ('Loader.class.php');

class InscritoDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "concursosxcandidatos";

	public function __construct() {
		parent::__construct(InscritoDAOPersistivel::NOME_TABELA);
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return parent::incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return parent::alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
		return parent::excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		$resultados = array();
		$resultados = parent::consultar($banco, $campos, $filtro, $camposOrdem, $sql);
		return $this->criaObjetos($resultados);
	}

	public function criaObjetos($resultados) {
		$resultinscritos = array();
		foreach ($resultados as $linha) {
			$inscrito = new Inscrito();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$inscrito->setId($valor);
				}
				elseif (strcasecmp($campo, "idconcurso") == 0) {
					$inscrito->setIDConcurso($valor);
				}
				elseif (strcasecmp($campo, "idpessoa") == 0) {
					$inscrito->setIDPessoa($valor);
				}
				elseif (strcasecmp($campo, "processo") == 0) {
					$inscrito->setProcesso($valor);
				}
				elseif (strcasecmp($campo, "nota") == 0) {
					$inscrito->setNota($valor);
				}
				elseif (strcasecmp($campo, "conceito") == 0) {
					$inscrito->setConceito($valor);
				}
				elseif (strcasecmp($campo, "nome") == 0) {
				  $inscrito->setNome($valor);
				}
				elseif (strcasecmp($campo, "edital") == 0) {
				  $inscrito->setEdital($valor);
 			  }
 			  elseif (strcasecmp($campo, "descricao") == 0) {
 			    $inscrito->setDescricao($valor);
 			  }
 			  elseif (strcasecmp($campo, "status") == 0) {
 			    $inscrito->setStatus($valor);
 			  }
				elseif (strcasecmp($campo, "sim") == 0) {
				  $inscrito->setSim($valor);
 			  }
				elseif (strcasecmp($campo, "nao") == 0) {
				  $inscrito->setNao($valor);
 			  }
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$inscrito->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$inscrito->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$inscrito->setDHModificacao($valor);
				}
			}
			$resultinscritos[] = $inscrito;
		}
		return $resultinscritos;
	}
}
?>
