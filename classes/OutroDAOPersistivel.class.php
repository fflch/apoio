<?php

require_once ('Loader.class.php');

class OutroDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "outros";

	public function __construct() {
		parent::__construct(OutroDAOPersistivel::NOME_TABELA);
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
		$resultoutros = array();
		foreach ($resultados as $linha) {
			$outro = new Outro();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$outro->setId($valor);
				}
				elseif (strcasecmp($campo, "idcedula") == 0) {
					$outro->setIDCedula($valor);
				}
				elseif (strcasecmp($campo, "pergunta") == 0) {
					$outro->setPergunta($valor);
				}
				elseif (strcasecmp($campo, "sim") == 0) {
					$outro->setSim($valor);
				}
				elseif (strcasecmp($campo, "nao") == 0) {
					$outro->setNao($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$outro->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$outro->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$outro->setDHModificacao($valor);
				}
			}
			$resultoutros[] = $outro;
		}
		return $resultoutros;
	}
}
?>
