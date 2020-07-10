<?php

require_once ('Loader.class.php');

class UsuarioDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "usuarios";

	public function __construct() {
		parent::__construct(UsuarioDAOPersistivel::NOME_TABELA);
	}

	public function incluir(DAOBanco $banco, $camposValores) {
		return parent::incluir($banco, $camposValores);
	}

	public function alterar(DAOBanco $banco, $camposValores, FiltroSQL $filtro = null, $sql = null) {
		return parent::alterar($banco, $camposValores, $filtro, $sql);
	}

	public function excluir(DAOBanco $banco, FiltroSQL $filtro = null) {
		return parent::excluir($banco, $filtro);
	}

	public function consultar(DAOBanco $banco, $campos, FiltroSQL $filtro = null, $camposOrdem = null, $sql = null) {
		$resultados = array();
		$resultados = parent::consultar($banco, $campos, $filtro, $camposOrdem, $sql);
		return $this->criaObjetos($resultados);
	}

	public function criaObjetos($resultados) {
		$resultusuarios = array();
		foreach ($resultados as $linha) {
			$usuario = new Usuario();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$usuario->setId($valor);
				}
				elseif (strcasecmp($campo, "login") == 0) {
					$usuario->setLogin($valor);
				}
				elseif (strcasecmp($campo, "senha") == 0) {
					$usuario->setSenha($valor);
				}
				elseif (strcasecmp($campo, "nome") == 0) {
					$usuario->setNome($valor);
				}
				elseif (strcasecmp($campo, "status") == 0) {
					$usuario->setStatus($valor);
				}
				elseif (strcasecmp($campo, "nivel") == 0) {
					$usuario->setNivel($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$usuario->setIDUsuario($valor);
				}
			  elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$usuario->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$usuario->setDHModificacao($valor);
				}
			}
			$resultusuarios[] = $usuario;
		}
		return $resultusuarios;
	}
}
?>
