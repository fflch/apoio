<?php
require_once ('Loader.class.php');

final class SimpleFactoryDAOBanco {
	const BANCO_FIREBIRD = "FIREBIRD";
	private $daoBanco;
	
	public function criaInstanciaBanco($produto, $servidor, $usuario, $senha, $banco) {
		$this->setObjetoDAOBanco(null);
		switch ($produto) {
			case self::BANCO_FIREBIRD:
				$this->setObjetoDAOBanco(FirebirdDAOBanco::getInstancia($servidor, $usuario, $senha, $banco));
 				break;

			default:
				throw new Exception("Tipo especificado de banco de dados n&atilde;o existe. Banco: " . $produto);
		}
		return $this->getObjetoDAOBanco();
	}
	
	private function getObjetoDAOBanco() {
		return $this->daoBanco;
	}
	
	private function setObjetoDAOBanco($daoBanco) {
		$this->daoBanco = $daoBanco;
	}
}
?>