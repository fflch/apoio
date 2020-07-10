<?php

require_once ('Loader.class.php');

class SuplenteDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "composicoessuplentes";

	public function __construct() {
		parent::__construct(SuplenteDAOPersistivel::NOME_TABELA);
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
		$resultsuplentes = array();
		foreach ($resultados as $linha) {
			$suplente = new Suplente();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$suplente->setId($valor);
				}
				elseif (strcasecmp($campo, "idcomposicaotitular") == 0) {
					$suplente->setIDTitular($valor);
				}
				elseif (strcasecmp($campo, "titular") == 0) {
				  $suplente->setNomeTitular($valor);
				}
				elseif (strcasecmp($campo, "cargo") == 0) {
				  $suplente->setCargo($valor);
			  }
				elseif (strcasecmp($campo, "idpessoa") == 0) {
					$suplente->setIDPessoa($valor);
				}
				elseif (strcasecmp($campo, "suplente") == 0) {
				  $suplente->setNomeSuplente($valor);
				}
				elseif (strcasecmp($campo, "iddepartamento") == 0) {
					$suplente->setIDEpto($valor);
				}
				elseif (strcasecmp($campo, "pertence") == 0) {
					$suplente->setPertence($valor);
				}
				elseif (strcasecmp($campo, "inicio") == 0) {
					$suplente->setInicio($valor);
				}
				elseif (strcasecmp($campo, "termino") == 0) {
					$suplente->setTermino($valor);
				}
				elseif (strcasecmp($campo, "ativo") == 0) {
					$suplente->setAtivo($valor);
				}
				elseif (strcasecmp($campo, "observacao") == 0) {
					$suplente->setObservacao($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$suplente->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$suplente->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$suplente->setDHModificacao($valor);
				}
			}
			$resultsuplentes[] = $suplente;
		}
		return $resultsuplentes;
	}
}
?>
