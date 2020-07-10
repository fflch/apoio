<?php
require_once ('Loader.class.php');

abstract class Helper {
	const OPERACAO_INCLUIR = 'incluir';
	const OPERACAO_ALTERAR = 'alterar';
	const OPERACAO_EXCLUIR = 'excluir';
	const OPERACAO_CONSULTAR = 'consultar';

	public abstract function incluir(DAOBanco $banco, $camposValores);
	public abstract function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null);
	public abstract function excluir(DAOBanco $banco, FiltroSQL $filtro = null);
	public abstract function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql= null);
	public abstract function validaDados($vars, $camposValores);
}
?>
