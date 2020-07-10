<?php

require_once ('Loader.class.php');

class VotoBancaRN extends RN {
	private $votobancaDAO;

	public function __construct() {
		$this->votobancaDAO = new VotoBancaDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->votobancaDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->votobancaDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->votobancaDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->votobancaDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
