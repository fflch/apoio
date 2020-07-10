<?php

require_once ('Loader.class.php');

class TituloRN extends RN {
	private $tituloDAO;

	public function __construct() {
		$this->tituloDAO = new TituloDAOPersistivel();

	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->tituloDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->tituloDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->tituloDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->tituloDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
