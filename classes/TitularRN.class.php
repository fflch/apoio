<?php

require_once ('Loader.class.php');

class TitularRN extends RN {
	private $titularDAO;

	public function __construct() {
		$this->titularDAO = new TitularDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->titularDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->titularDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->titularDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->titularDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
