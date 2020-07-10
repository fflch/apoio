<?php

require_once ('Loader.class.php');

class SuplenteRN extends RN {
	private $suplenteDAO;

	public function __construct() {
		$this->suplenteDAO = new SuplenteDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->suplenteDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->suplenteDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->suplenteDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->suplenteDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
