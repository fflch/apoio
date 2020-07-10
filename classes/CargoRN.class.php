<?php

require_once ('Loader.class.php');

class CargoRN extends RN {
	private $cargoDAO;

	public function __construct() {
		$this->cargoDAO = new CargoDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->cargoDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->cargoDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->cargoDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->cargoDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
