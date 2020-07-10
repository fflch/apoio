<?php

require_once ('Loader.class.php');

class VotoRelatorioDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "votorelatorio";

	public function __construct() {
		parent::__construct(VotoRelatorioDAOPersistivel::NOME_TABELA);
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
		$resultvotorelatorio = array();
		foreach ($resultados as $linha) {
			$votorelatorio = new VotoRelatorio();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "idcedula") == 0) {
					$votorelatorio->setIDCedula($valor);
				}
				elseif (strcasecmp($campo, "idvotante") == 0) {
					$votorelatorio->setIDVotante($valor);
				}
				elseif (strcasecmp($campo, "nome") == 0) {
					$votorelatorio->setNome($valor);
				}
				elseif (strcasecmp($campo, "voto") == 0) {
					$votorelatorio->setVoto($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$votorelatorio->setDHInclusao($valor);
				}
			}
			$resultvotorelatorio[] = $votorelatorio;
		}
		return $resultvotorelatorio;
	}
}
?>
