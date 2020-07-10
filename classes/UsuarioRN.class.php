<?php

require_once ('Loader.class.php');

class UsuarioRN extends RN {
	private $usuarioDAO;

	public function __construct() {
		$this->usuarioDAO = new UsuarioDAOPersistivel();

	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return $this->usuarioDAO->incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return $this->usuarioDAO->alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
    return $this->usuarioDAO->excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		return $this->usuarioDAO->consultar($banco, $campos, $filtro, $camposOrdem, $sql);
	}

	public function validarLoginSenha(DAOBanco $banco, $login, $codigo = null) {
		try {
		  if ($codigo == null) {
		    $sql = "SELECT LOGIN FROM USUARIOS WHERE LOGIN='$login'";
		  }
		  else {
		    $sql = "SELECT LOGIN FROM USUARIOS WHERE LOGIN='$login' AND ID<>$codigo";
		  }
			$resultados = $this->consultar($banco, null, null, null, $sql);
			if (count($resultados) > 0) {
				return true;
			}
		}
		catch (Exception $e) {
			throw new Exception("N&atilde;o foi poss&iacute;vel validar login. Erro: " . $e->getMessage());
		}
		return false;
	}
}
?>
