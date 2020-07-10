<?php

require_once ('Loader.class.php');

class ComissaoRN extends RN {
	private $comissaoDAO;

	public function __construct() {
		$this->comissaoDAO = new ComissaoDAOPersistivel();

	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->comissaoDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->comissaoDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->comissaoDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->comissaoDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
