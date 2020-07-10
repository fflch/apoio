<?php

require_once ('Loader.class.php');

class TitularHelper extends Helper {
	private $titularRN;

	public function __construct() {
		$this->titularRN = new TitularRN();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->titularRN->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->titularRN->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
		return $this->titularRN->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->titularRN->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

	public function validaDados($vars, $camposValores) {
		throw new Exception("M&eacute;todo validaDados da classe UsuarioHelper n&atilde;o implementado..");
	}

}
?>
