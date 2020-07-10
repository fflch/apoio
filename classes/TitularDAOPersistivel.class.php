<?php

require_once ('Loader.class.php');

class TitularDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "composicoestitulares";

	public function __construct() {
		parent::__construct(TitularDAOPersistivel::NOME_TABELA);
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
		$resultitulares = array();
		foreach ($resultados as $linha) {
			$titular = new Titular();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$titular->setId($valor);
				}
				elseif (strcasecmp($campo, "idpessoa") == 0) {
					$titular->setIDPessoa($valor);
				}
				elseif (strcasecmp($campo, "nome") == 0) {
					$titular->setNome($valor);
				}
				elseif (strcasecmp($campo, "idcargo") == 0) {
					$titular->setIDCargo($valor);
				}
				elseif (strcasecmp($campo, "cargo") == 0) {
					$titular->setCargo($valor);
				}
				elseif (strcasecmp($campo, "iddepartamento") == 0) {
					$titular->setIDEpto($valor);
				}
				elseif (strcasecmp($campo, "pertence") == 0) {
					$titular->setPertence($valor);
				}
				elseif (strcasecmp($campo, "inicio") == 0) {
					$titular->setInicio($valor);
				}
				elseif (strcasecmp($campo, "termino") == 0) {
					$titular->setTermino($valor);
				}
				elseif (strcasecmp($campo, "ativo") == 0) {
					$titular->setAtivo($valor);
				}
				elseif (strcasecmp($campo, "observacao") == 0) {
					$titular->setObservacao($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$titular->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$titular->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$titular->setDHModificacao($valor);
				}
			}
			$resultitulares[] = $titular;
		}
		return $resultitulares;
	}
}
?>
