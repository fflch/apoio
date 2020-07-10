<?php

require_once ('Loader.class.php');

class VotoCedulaRN extends RN {
	private $votocedulaDAO;

	public function __construct() {
		$this->votocedulaDAO = new VotoCedulaDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->votocedulaDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->votocedulaDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->votocedulaDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->votocedulaDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
