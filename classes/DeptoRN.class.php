<?php

require_once ('Loader.class.php');

class DeptoRN extends RN {
	private $deptoDAO;

	public function __construct() {
		$this->deptoDAO = new DeptoDAOPersistivel();

	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->deptoDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->deptoDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->deptoDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->deptoDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
