<?php

require_once ('Loader.class.php');

class PessoaRN extends RN {
	private $pessoaDAO;

	public function __construct() {
		$this->pessoaDAO = new PessoaDAOPersistivel();

	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->pessoaDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->pessoaDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->pessoaDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->pessoaDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
