<?php

require_once ('Loader.class.php');

class CedulaRN extends RN {
	private $cedulaDAO;

	public function __construct() {
		$this->cedulaDAO = new CedulaDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->cedulaDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->cedulaDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->cedulaDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->cedulaDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
