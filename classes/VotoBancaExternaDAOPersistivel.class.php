<?php

require_once ('Loader.class.php');

class VotoBancaExternaDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "votobancaexterna";

	public function __construct() {
		parent::__construct(VotoBancaExternaDAOPersistivel::NOME_TABELA);
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
		$resultvotobancaexterna = array();
		foreach ($resultados as $linha) {
			$votobancaexterna = new VotoBancaExterna();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "idcedula") == 0) {
					$votobancaexterna->setIDCedula($valor);
				}
				elseif (strcasecmp($campo, "idvotante") == 0) {
					$votobancaexterna->setIDVotante($valor);
				}
				elseif (strcasecmp($campo, "nome") == 0) {
					$votobancaexterna->setNome($valor);
				}
				elseif (strcasecmp($campo, "idpessoacomissao") == 0) {
					$votobancaexterna->setIDPessoaComissao($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$votobancaexterna->setDHInclusao($valor);
				}
			}
			$resultvotobancaexterna[] = $votobancaexterna;
		}
		return $resultvotobancaexterna;
	}
}
?>
