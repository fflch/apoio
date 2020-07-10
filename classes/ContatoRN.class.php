<?php

require_once ('Loader.class.php');

class ContatoRN extends RN {
	private $contatoDAO;

	public function __construct() {
		$this->contatoDAO = new ContatoDAOPersistivel();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->contatoDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->contatoDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->contatoDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->contatoDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
