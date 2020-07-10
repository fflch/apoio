<?php

require_once ('Loader.class.php');

class AreaRN extends RN {
	private $areaDAO;

	public function __construct() {
		$this->areaDAO = new AreaDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->areaDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->areaDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->areaDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->areaDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
