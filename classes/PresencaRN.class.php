<?php

require_once ('Loader.class.php');

class PresencaRN extends RN {
	private $presencaDAO;

	public function __construct() {
		$this->presencaDAO = new PresencaDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->presencaDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->presencaDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->presencaDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->presencaDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
