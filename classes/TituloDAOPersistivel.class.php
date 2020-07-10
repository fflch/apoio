<?php

require_once ('Loader.class.php');

class TituloDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "titulacoes";

	public function __construct() {
		parent::__construct(TituloDAOPersistivel::NOME_TABELA);
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
		$resultitulos = array();
		foreach ($resultados as $linha) {
			$titulo = new Titulo();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$titulo->setId($valor);
				}
				elseif (strcasecmp($campo, "titulo") == 0) {
					$titulo->setTitulo($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$titulo->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$titulo->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$titulo->setDHModificacao($valor);
				}
			}
			$resultitulos[] = $titulo;
		}
		return $resultitulos;
	}
}
?>
