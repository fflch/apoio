<?php

require_once ('Loader.class.php');

class VotoInscricaoRN extends RN {
	private $votoinscricaoDAO;

	public function __construct() {
		$this->votoinscricaoDAO = new VotoInscricaoDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->votoinscricaoDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->votoinscricaoDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->votoinscricaoDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->votoinscricaoDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
