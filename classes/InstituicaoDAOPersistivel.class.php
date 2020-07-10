<?php

require_once ('Loader.class.php');

class InstituicaoDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "instituicao";

	public function __construct() {
		parent::__construct(InstituicaoDAOPersistivel::NOME_TABELA);
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
		$resultinstituicoes = array();
		foreach ($resultados as $linha) {
			$instituicao = new Instituicao();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$instituicao->setId($valor);
				}
				elseif (strcasecmp($campo, "sigla") == 0) {
					$instituicao->setSigla($valor);
				}
				elseif (strcasecmp($campo, "instituicao") == 0) {
					$instituicao->setInstituicao($valor);
				}
				elseif (strcasecmp($campo, "unidade") == 0) {
				  $instituicao->setUnidade($valor);
				}
				elseif (strcasecmp($campo, "local") == 0) {
				  $instituicao->setLocal($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$instituicao->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$instituicao->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$instituicao->setDHModificacao($valor);
				}
			}
			$resultinstituicoes[] = $instituicao;
		}
		return $resultinstituicoes;
	}
}
?>
