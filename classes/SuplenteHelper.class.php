<?php

require_once ('Loader.class.php');

class SuplenteHelper extends Helper {
	private $suplenteRN;

	public function __construct() {
		$this->suplenteRN = new SuplenteRN();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->suplenteRN->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->suplenteRN->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
		return $this->suplenteRN->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->suplenteRN->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

	public function validaDados($vars, $camposValores) {
		throw new Exception("M&eacute;todo validaDados da classe UsuarioHelper n&atilde;o implementado..");
	}

}
?>
