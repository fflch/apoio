<?php

require_once ('Loader.class.php');

class RelatorioDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "relatorios";

	public function __construct() {
		parent::__construct(RelatorioDAOPersistivel::NOME_TABELA);
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
		$resultrelatorios = array();
		foreach ($resultados as $linha) {
			$relatorio = new Relatorio();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$relatorio->setId($valor);
				}
				elseif (strcasecmp($campo, "idcedula") == 0) {
					$relatorio->setIDCedula($valor);
				}
				elseif (strcasecmp($campo, "pergunta") == 0) {
					$relatorio->setPergunta($valor);
				}
				elseif (strcasecmp($campo, "sim") == 0) {
					$relatorio->setSim($valor);
				}
				elseif (strcasecmp($campo, "nao") == 0) {
					$relatorio->setNao($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$relatorio->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$relatorio->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$relatorio->setDHModificacao($valor);
				}
			}
			$resultrelatorios[] = $relatorio;
		}
		return $resultrelatorios;
	}
}
?>
