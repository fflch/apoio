<?php

require_once ('Loader.class.php');

class VotoBancaDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "votobanca";

	public function __construct() {
		parent::__construct(VotoBancaDAOPersistivel::NOME_TABELA);
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
		$resultvotobanca = array();
		foreach ($resultados as $linha) {
			$votobanca = new VotoBanca();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "idcedula") == 0) {
					$votobanca->setIDCedula($valor);
				}
				elseif (strcasecmp($campo, "idvotante") == 0) {
					$votobanca->setIDVotante($valor);
				}
				elseif (strcasecmp($campo, "nome") == 0) {
					$votobanca->setNome($valor);
				}
				elseif (strcasecmp($campo, "idpessoacomissao") == 0) {
					$votobanca->setIDPessoaComissao($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$votobanca->setDHInclusao($valor);
				}
			}
			$resultvotobanca[] = $votobanca;
		}
		return $resultvotobanca;
	}
}
?>
