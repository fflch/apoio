<?php

require_once ('Loader.class.php');

class VotoRelatorioHelper extends Helper {
	private $votorelatorioRN;

	public function __construct() {
		$this->votorelatorioRN = new VotoRelatorioRN();
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->votorelatorioRN->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->votorelatorioRN->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
		return $this->votorelatorioRN->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->votorelatorioRN->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

	public function validaDados($vars, $camposValores) {
		throw new Exception("M&eacute;todo validaDados da classe UsuarioHelper n&atilde;o implementado..");
	}

}
?>
