<?php

require_once ('Loader.class.php');

class VotoOutroRN extends RN {
	private $votooutroDAO;

	public function __construct() {
		$this->votooutroDAO = new VotoOutroDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->votooutroDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->votooutroDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->votooutroDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->votooutroDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
