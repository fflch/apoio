<?php

require_once ('Loader.class.php');

class TipoContatoHelper extends Helper {
	private $tipocontatoRN;

	public function __construct() {
		$this->tipocontatoRN = new TipoContatoRN();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->tipocontatoRN->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->tipocontatoRN->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
		return $this->tipocontatoRN->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->tipocontatoRN->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

	public function validaDados($vars, $camposValores) {
		throw new Exception("M&eacute;todo validaDados da classe UsuarioHelper n&atilde;o implementado..");
	}

}
?>
