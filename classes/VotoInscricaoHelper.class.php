<?php

require_once ('Loader.class.php');

class VotoInscricaoHelper extends Helper {
	private $votoinscricaoRN;

	public function __construct() {
		$this->votoinscricaoRN = new VotoInscricaoRN();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->votoinscricaoRN->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->votoinscricaoRN->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
		return $this->votoinscricaoRN->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->votoinscricaoRN->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

	public function validaDados($vars, $camposValores) {
		throw new Exception("M&eacute;todo validaDados da classe UsuarioHelper n&atilde;o implementado..");
	}

}
?>
