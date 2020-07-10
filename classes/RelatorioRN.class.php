<?php

require_once ('Loader.class.php');

class RelatorioRN extends RN {
	private $relatorioDAO;

	public function __construct() {
		$this->relatorioDAO = new RelatorioDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->relatorioDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->relatorioDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->relatorioDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->relatorioDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
