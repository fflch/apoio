<?php

require_once ('Loader.class.php');

class DeptoDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "departamentos";

	public function __construct() {
		parent::__construct(DeptoDAOPersistivel::NOME_TABELA);
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
		$resultdeptos = array();
		foreach ($resultados as $linha) {
			$depto = new Depto();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$depto->setId($valor);
				}
				elseif (strcasecmp($campo, "sigla") == 0) {
					$depto->setSigla($valor);
				}
				elseif (strcasecmp($campo, "depto") == 0) {
					$depto->setDepto($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$depto->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$depto->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$depto->setDHModificacao($valor);
				}
			}
			$resultdeptos[] = $depto;
		}
		return $resultdeptos;
	}
}
?>
