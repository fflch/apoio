<?php

require_once ('Loader.class.php');

class TipoContatoRN extends RN {
	private $tipocontatoDAO;

	public function __construct() {
		$this->tipocontatoDAO = new TipoContatoDAOPersistivel();

	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->tipocontatoDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->tipocontatoDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->tipocontatoDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->tipocontatoDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
