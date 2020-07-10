<?php

require_once ('Loader.class.php');

class OutroRN extends RN {
	private $outroDAO;

	public function __construct() {
		$this->outroDAO = new OutroDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->outroDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->outroDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->outroDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->outroDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
