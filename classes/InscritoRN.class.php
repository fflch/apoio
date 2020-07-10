<?php

require_once ('Loader.class.php');

class InscritoRN extends RN {
	private $inscritoDAO;

	public function __construct() {
		$this->inscritoDAO = new InscritoDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->inscritoDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->inscritoDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->inscritoDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->inscritoDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
