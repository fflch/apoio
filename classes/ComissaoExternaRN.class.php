<?php

require_once ('Loader.class.php');

class ComissaoExternaRN extends RN {
	private $comissaoexternaDAO;

	public function __construct() {
		$this->comissaoexternaDAO = new ComissaoExternaDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->comissaoexternaDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->comissaoexternaDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->comissaoexternaDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->comissaoexternaDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
