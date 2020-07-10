<?php

require_once ('Loader.class.php');

class TipoContatoDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "tiposcontatos";

	public function __construct() {
		parent::__construct(TipoContatoDAOPersistivel::NOME_TABELA);
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
		$resultipos = array();
		foreach ($resultados as $linha) {
			$tipo = new TipoContato();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$tipo->setId($valor);
				}
				elseif (strcasecmp($campo, "tipo") == 0) {
					$tipo->setTipo($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$tipo->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$tipo->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$tipo->setDHModificacao($valor);
				}
			}
			$resultipos[] = $tipo;
		}
		return $resultipos;
	}
}
?>
