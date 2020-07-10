<?php
require_once ('Loader.class.php');

abstract class DAOPersistivel {
	private $nomeTabela;

	public function __construct($nomeTabela) {
		$this->setNomeTabela($nomeTabela);
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		$sql = "";
		$size = 0;
		$conta = 0;
		$sql = "INSERT INTO " . strtoupper($this->getNomeTabela()) . " (";
		$size = count($camposValores);
		foreach ($camposValores as $campo => $valor) {
			$sql.= $campo;
			if ($conta < ($size-1)) {
				$sql.= ", ";
			}
			$conta++;
		}
		$sql.= ") VALUES (";
		$conta = 0;
		foreach ($camposValores as $valor) {
			$sql.= $this->formataValor($valor, $conta, $size);
			$conta++;
		}
		$sql.= ")";
		if ($banco->abreConexao() == true) {
			$retorno = $banco->incluir($sql);
			$banco->fechaConexao();
			return $retorno;
		}
		else {
			return false;
		}
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
	  if ( is_null($sql) ) {
		  $sql = "";
		  $size = 0;
		  $conta = 0;
		  $sizeFiltro = 0;
		  $sql = "UPDATE " . strtoupper($this->getNomeTabela()) . " SET ";
		  $size = count($camposValores);
		  foreach ($camposValores as $campo => $valor) {
			  $sql.= $campo . " = ";
			  $sql.= $this->formataValor($valor, $conta, $size);
			  $conta++;
		  }
		  if (!is_null($filtro)) {
			  $sizeFiltro = count($filtro->getCamposFiltro());
			  if ($sizeFiltro > 0) {
			  	$conta = 0;
				  $sql.= " WHERE ";
				  foreach ($filtro->getCamposFiltro() as $campo => $valor) {
					  $sql.= $campo . $filtro->getOperador() . $this->formataValor($valor, 0, 0);
					  if ($conta < ($sizeFiltro-1)) {
					   	$sql.= " " . $filtro->getConector() . " ";
					  }
					  $conta++;
				  }
			  }
		  }
		}
		//echo $sql;
		if ($banco->abreConexao() == true) {
			$retorno = $banco->alterar($sql);
			$banco->fechaConexao();
			return $retorno;
		}
		else {
			return false;
		}
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
		$sql = "";
		$sizeFiltro = 0;
		$conta = 0;
		$sql = "DELETE FROM " . strtoupper($this->getNomeTabela());
		if (!is_null($filtro)) {
			$sizeFiltro = count($filtro->getCamposFiltro());
			$sql.= " WHERE ";
			foreach ($filtro->getCamposFiltro() as $campo => $valor) {
				$sql.= $campo . $filtro->getOperador() . $this->formataValor($valor, 0, 0);
				if ($conta < ($sizeFiltro-1)) {
					$sql.= " " . $filtro->getConector() . " ";
				}
				$conta++;
			}
		}
		if ($banco->abreConexao() == true) {
			$retorno = $banco->excluir($sql);
			$banco->fechaConexao();
			return $retorno;
		}
		else {
			return false;
		}
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
    if ( is_null($sql) ) {
  		$sql = "";
		  $size = 0;
		  $sizeFiltro = 0;
		  $conta = 0;
		  $contaOrdem = 0;
		  $res = null;
		  $size = count($campos);
		  $sizeOrdem = count($camposOrdem);
		  if ($size > 0) {
		  	$sql = "SELECT ";
		    	foreach ($campos as $valor) {
				  $sql.= $valor;
			    if ($conta < ($size-1)) {
				    $sql.= ", ";
				  }
				  $conta++;
			   }
		  }
		  else {
			  $sql = "SELECT * ";
		  }
		  $sql.= " FROM " . $this->getNomeTabela();
		  $conta = 0;
		  if (!is_null($filtro)) {
			  $sizeFiltro = count($filtro->getCamposFiltro());
			  $sql.= " WHERE ";
			  foreach ($filtro->getCamposFiltro() as $campo => $valor) {
				  $sql.= $campo . " " . $filtro->getOperador() . " " . $this->formataValor($valor, 0, 0);
				  if ($conta < ($sizeFiltro-1)) {
					  $sql.= " " . $filtro->getConector() . " ";
			   	}
				  $conta++;
		  	}
	  	}
		  if ($sizeOrdem > 0 ) {
			  $sql.= " ORDER BY ";
			  foreach ($camposOrdem as $valor) {
			  	$sql.= $valor;
				  if ($contaOrdem < ($sizeOrdem-1)) {
					  $sql.= ", ";
				  }
				  $contaOrdem++;
			  }
		  }
    }
    //echo $sql;
		if ($banco->abreConexao() == true) {
			$res = $banco->consultar($sql);
			$banco->fechaConexao();
			return $res;
		}
		else {
			return false;
		}
	}

	private function formataValor($valor, $posAtual, $posTotal) {
		$valor = strip_tags($valor);
		$valor = trim($valor);
		$valor = preg_replace("@(--|\#|\*|;)@s", "", $valor);
		$valor = urldecode($valor);
		$valor = utf8_decode($valor);
		if (is_string($valor)) {
			if (!get_magic_quotes_gpc()) {
				// se usar mysql descomentar a linha abaixo e comentar a pr√xima
				// $retorno = "'" . addslashes($valor) . "'";
				// se usar firebird descomentar a linha abaixo
				$retorno = "'".str_replace("'","''",$valor)."'";
			}
			else {
				$retorno = "'" . $valor . "'";
			}
		}
		else if (empty($valor)) {
			$retorno = "NULL";
		}
		else {
			$retorno = $valor;
		}
		if ($posAtual < ($posTotal-1)) {
			$retorno.= ", ";
		}
		return $retorno;
	}

	protected function getNomeTabela() {
		return $this->nomeTabela;
	}

	protected function setNomeTabela($nomeTabela) {
		$this->nomeTabela = $nomeTabela;
	}

	public abstract function criaObjetos($resultados);
}
?>
