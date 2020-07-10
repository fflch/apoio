<?php

require_once ('Loader.class.php');

class TitulacaoRN extends RN {
	private $titulacaoDAO;

	public function __construct() {
		$this->titulacaoDAO = new TitulacaoDAOPersistivel();

	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->titulacaoDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->titulacaoDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->titulacaoDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->titulacaoDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
