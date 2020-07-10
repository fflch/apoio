<?php

require_once ('Loader.class.php');

class InstituicaoRN extends RN {
	private $instituicaoDAO;

	public function __construct() {
		$this->instituicaoDAO = new InstituicaoDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->instituicaoDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->instituicaoDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->instituicaoDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->instituicaoDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
