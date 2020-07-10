<?php

require_once ('Loader.class.php');

class UsuarioHelper extends Helper {
	private $usuarioRN;

	public function __construct() {
		$this->usuarioRN = new UsuarioRN();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->usuarioRN->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->usuarioRN->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
		return $this->usuarioRN->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->usuarioRN->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

	public function validaDados($vars, $camposValores) {
		throw new Exception("M&eacute;todo validaDados da classe UsuarioHelper n&atilde;o implementado..");
	}

	public function validarLoginSenha(DAOBanco $banco, $login, $codigo = null) {
		try {
			return $this->usuarioRN->validarLoginSenha($banco, $login, $codigo);
		}
		catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}
}
?>
