<?php

require_once ('Loader.class.php');

class AreaDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "area";

	public function __construct() {
		parent::__construct(AreaDAOPersistivel::NOME_TABELA);
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
		$resultareas = array();
		foreach ($resultados as $linha) {
			$area = new Area();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$area->setId($valor);
				}
				elseif (strcasecmp($campo, "iddepto") == 0) {
					$area->setIDDepto($valor);
				}
				elseif (strcasecmp($campo, "area") == 0) {
					$area->setArea($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$area->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$area->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$area->setDHModificacao($valor);
				}
			}
			$resultareas[] = $area;
		}
		return $resultareas;
	}
}
?>
