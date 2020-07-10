<?php

require_once ('Loader.class.php');

class VotoBancaExternaHelper extends Helper {
	private $votobancaexternaRN;

	public function __construct() {
		$this->votobancaexternaRN = new VotoBancaExternaRN();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->votobancaexternaRN->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->votobancaexternaRN->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
		return $this->votobancaexternaRN->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->votobancaexternaRN->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

	public function validaDados($vars, $camposValores) {
		throw new Exception("M&eacute;todo validaDados da classe UsuarioHelper n&atilde;o implementado..");
	}

}
?>
