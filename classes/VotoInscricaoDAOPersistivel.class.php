<?php

require_once ('Loader.class.php');

class VotoInscricaoDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "votoinscricao";

	public function __construct() {
		parent::__construct(VotoInscricaoDAOPersistivel::NOME_TABELA);
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
		$resultvotoinscricao = array();
		foreach ($resultados as $linha) {
			$votoinscricao = new VotoInscricao();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "idcedula") == 0) {
					$votoinscricao->setIDCedula($valor);
				}
				elseif (strcasecmp($campo, "idvotante") == 0) {
					$votoinscricao->setIDVotante($valor);
				}
				elseif (strcasecmp($campo, "nome") == 0) {
					$votoinscricao->setNome($valor);
				}
				elseif (strcasecmp($campo, "idcandidato") == 0) {
					$votoinscricao->setIDCandidato($valor);
				}
				elseif (strcasecmp($campo, "voto") == 0) {
					$votoinscricao->setVoto($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$votoinscricao->setDHInclusao($valor);
				}
			}
			$resultvotoinscricao[] = $votoinscricao;
		}
		return $resultvotoinscricao;
	}
}
?>
