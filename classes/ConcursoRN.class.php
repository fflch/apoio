<?php

require_once ('Loader.class.php');

class ConcursoRN extends RN {
	private $concursoDAO;

	public function __construct() {
		$this->concursoDAO = new ConcursoDAOPersistivel();

	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->concursoDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->concursoDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->concursoDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->concursoDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

}
?>
