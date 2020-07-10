<?php

require_once ('Loader.class.php');

class VotoRelatorioRN extends RN {
	private $votorelatorioDAO;

	public function __construct() {
		$this->votorelatorioDAO = new VotoRelatorioDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->votorelatorioDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->votorelatorioDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->votorelatorioDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->votorelatorioDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
