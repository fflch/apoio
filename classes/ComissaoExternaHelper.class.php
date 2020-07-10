<?php

require_once ('Loader.class.php');

class ComissaoExternaHelper extends Helper {
	private $comissaoexternaRN;

	public function __construct() {
		$this->comissaoexternaRN = new ComissaoExternaRN();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->comissaoexternaRN->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->comissaoexternaRN->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
		return $this->comissaoexternaRN->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->comissaoexternaRN->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

	public function validaDados($vars, $camposValores) {
		throw new Exception("M&eacute;todo validaDados da classe UsuarioHelper n&atilde;o implementado..");
	}

}
?>
