<?php
require_once ('Loader.class.php');

abstract class DAOBanco implements DAO {
	private $emTransacao;
	private $autoCommit;
	
	private function __construct($emTransacao, $autoCommit) {
		$this->setEmTransacao($emTransacao);
		$this->setAutoCommit($autoCommit);
	}
	
	protected function isAutoCommit() {
		return $this->autoCommit;
	}
	
	protected function setAutoCommit($autoCommit) {
		$this->autoCommit = $autoCommit;
	}
	
	protected function isEmTransacao() {
		return $this->emTransacao;
	}
	
	protected function setEmTransacao($emTransacao) {
		$this->emTransacao = $emTransacao;
	}
	
	protected function inicializaConstrutor($emTransacao, $autoCommit) {
		$this->__construct($emTransacao, $autoCommit);
	}
}
?>