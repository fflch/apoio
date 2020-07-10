<?php

require_once ('Loader.class.php');

class CargoDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "cargos";

	public function __construct() {
		parent::__construct(CargoDAOPersistivel::NOME_TABELA);
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
		$resultcargos = array();
		foreach ($resultados as $linha) {
			$cargo = new Cargo();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$cargo->setId($valor);
				}
				elseif (strcasecmp($campo, "cargo") == 0) {
					$cargo->setCargo($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$cargo->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$cargo->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$cargo->setDHModificacao($valor);
				}
			}
			$resultcargos[] = $cargo;
		}
		return $resultcargos;
	}
}
?>
