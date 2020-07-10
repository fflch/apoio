<?php
require_once ('Loader.class.php');

interface DAO {
	public function abreConexao();
	public function fechaConsulta();
	public function fechaConexao();
	public function incluir($sql);
	public function alterar($sql);
	public function excluir($sql);
	public function consultar($sql);
	public function commit();
	public function rollback();
	public function startTransaction();
}
?>