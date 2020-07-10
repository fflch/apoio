<?php

require_once ('Loader.class.php');

class VotoBancaExternaRN extends RN {
	private $votobancaexternaDAO;

	public function __construct() {
		$this->votobancaexternaDAO = new VotoBancaExternaDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->votobancaexternaDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->votobancaexternaDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->votobancaexternaDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->votobancaexternaDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
