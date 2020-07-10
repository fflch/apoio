<?php
require_once ('Loader.class.php');

class FirebirdDAOBanco extends DAOBanco {
	private $servidor;
	private $usuario;
	private $senha;
	private $banco;
	private $conexao;
	private $comandoSQL;
	private static $instancia = null;

	private function __construct($servidor, $usuario, $senha, $banco) {
		parent::inicializaConstrutor(false, true);
		$this->setServidor($servidor);
		$this->setUsuario($usuario);
		$this->setSenha($senha);
		$this->setBanco($banco);
	}

	public function abreConexao() {
		if (!$this->getConexao()) {
			$this->setConexao(ibase_connect($this->getServidor() , $this->getUsuario() , $this->getSenha()));
			if (!$this->getConexao()) {
				throw new Exception("N&atilde;o foi poss&iacute;vel conectar no banco de dados. Erro: " . ibase_errmsg() . ". C�digo: " . ibase_errcode());
			}
		}
		else {
			if (!is_resource($this->getConexao())) {
				$this->setConexao(ibase_connect($this->getServidor() , $this->getUsuario() , $this->getSenha()));
			}
			if (!$this->getConexao()) {
				throw new Exception("N&atilde;o foi poss&iacute;vel conectar no banco de dados. Erro: " . ibase_errmsg() . ". C�digo: " . ibase_errcode());
			}
		}
		return true;
	}

	public function fechaConsulta() {
		ibase_free_result($this->getComandoSQL());
	}

	public function fechaConexao() {
		ibase_close($this->getConexao());
	}

	public function incluir($sql) {
		$this->setComandoSQL(ibase_query($this->getConexao(), $sql));
		if (!$this->getComandoSQL()) {
			throw new Exception("N&atilde;o foi poss&iacutevel executar a query de inser&ccedil;&atilde;o. Query: " . $sql . " Erro: " . ibase_errmsg() . ". C&oacute;digo: " . ibase_errcode());
		}
		else {
			return true;
		}
	}

	public function alterar($sql) {
		$this->setComandoSQL(ibase_query($this->getConexao(), $sql));
		if (!$this->getComandoSQL()) {
			throw new Exception("N&atilde;o foi poss&iacute;vel executar a query de altera&ccedil;&atilde;o. Query: " . $sql . " Erro: " . ibase_errmsg() . ". C&oacute;digo: " . ibase_errcode());
		}
		else {
			return true;
		}
	}

	public function excluir($sql) {
		$this->setComandoSQL(ibase_query($this->getConexao(), $sql));
		if (!$this->getComandoSQL()) {
			throw new Exception("N&atilde;o foi poss&iacute;vel executar a query de exclus&atilde;o. Query: " . $sql . " Erro: " . ibase_errmsg() . ". C&oacute;digo: " . ibase_errcode());
		}
		else {
			return true;
		}
	}

	public function consultar($sql) {
		$registros = array();
		$linha = null;
		$conta = 0;
		$this->setComandoSQL(ibase_query($this->getConexao(), $sql));
		if (!$this->getComandoSQL()) {
			throw new Exception("N&atilde;o foi poss&iacute;vel executar a query de consulta. Query: " . $sql . " Erro: " . ibase_errmsg() . ". C&oacute;digo: " . ibase_errcode());
		}
		else {
			while ($linha = ibase_fetch_object($this->getComandoSQL())) {
				$registros[$conta] = $linha;
				$conta++;
			}
			return $registros;
		}
	        $this->fechaConsulta();
	}

	public function commit() {
		if ($this->isEmTransacao() && !$this->isAutoCommit()) {
			$this->setComandoSQL(ibase_query("COMMIT"));
			if (!$this->getComandoSQL()) {
				throw new Exception("N&atilde;o foi poss&iacute;vel commitar a transa&ccedil;&atilde;o." . " Erro: " . ibase_errmsg() . ". C�digo: " . ibase_errcode());
			}
			else {
				$this->setComandoSQL(ibase_query("SET AUTOCOMMIT=1"));
				if (!$this->getComandoSQL()) {
					throw new Exception("N&atilde;o foi poss&iacute;vel configurar a transa&ccedil;&atilde;o para autocommit." . " Erro: " . ibase_errmsg() . ". C&oacute;digo: " . ibase_errcode());
				}
				else {
					$this->setAutoCommit(true);
					$this->setEmTransacao(false);
					return true;
				}
			}
		}
		return false;
	}

	public function rollback() {
		if ($this->isEmTransacao() && !$this->isAutoCommit()) {
			$this->setComandoSQL(ibase_query("ROLLBACK"));
			if (!$this->getComandoSQL()) {
				throw new Exception("N&atilde;o foi poss&iacute;vel efetuar o rollback da transa&ccedil;&atilde;o." . " Erro: " . ibase_errmsg() . ". C&oacute;digo: " . ibase_errcode());
			}
			else {
				$this->setComandoSQL(ibase_query("SET AUTOCOMMIT=1"));
				if (!$this->getComandoSQL()) {
					throw new Exception("N&atilde;o foi poss&iacute;vel configurar a transa&ccedil;&atilde;o para autocommit." . " Erro: " . ibase_errmsg() . ". C&oacute;digo: " . ibase_errcode());
				}
				else {
					$this->setAutoCommit(true);
					$this->setEmTransacao(false);
					return true;
				}
			}
		}
		return false;
	}

	public function startTransaction() {
		if (!$this->isEmTransacao() && $this->isAutoCommit()) {
			$this->setComandoSQL(ibase_query("SET AUTOCOMMIT=0"));
			if (!$this->getComandoSQL()) {
				throw new Exception("N&atilde;o foi poss&iacute;vel configurar a transa&ccedil;&atilde;o para autocommit." . " Erro: " . ibase_errmsg() . ". C&oacute;digo: " . ibase_errcode());
			}
			else {
				$this->setAutoCommit(false);
				$this->setEmTransacao(true);
				return true;
			}
		}
		return false;
	}

	public function setServidor($servidor) {
		$this->servidor = $servidor;
	}

	public function getServidor() {
		return $this->servidor;
	}

	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}

	public function getUsuario() {
		return $this->usuario;
	}

	public function setSenha($senha) {
		$this->senha = $senha;
	}

	public function getSenha() {
		return $this->senha;
	}

	public function setBanco($banco) {
		$this->banco = $banco;
	}

	public function getBanco() {
		return $this->banco;
	}

	public function setConexao($conexao) {
		$this->conexao = $conexao;
	}
	public function getConexao() {
		return $this->conexao;
	}

	public function setComandoSQL($comandoSQL) {
		$this->comandoSQL = $comandoSQL;
	}

	public function getComandoSQL() {
		return $this->comandoSQL;
	}

	public static function getInstancia($servidor, $usuario, $senha, $banco) {
		if (is_null(self::$instancia)) {
			self::$instancia = new self($servidor, $usuario, $senha, $banco);
		}
		return self::$instancia;
	}
}
?>
