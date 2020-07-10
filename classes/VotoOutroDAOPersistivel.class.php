<?php

require_once ('Loader.class.php');

class VotoOutroDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "votooutro";

	public function __construct() {
		parent::__construct(VotoOutroDAOPersistivel::NOME_TABELA);
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
		$resultvotooutro = array();
		foreach ($resultados as $linha) {
			$votooutro = new VotoOutro();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "idcedula") == 0) {
					$votooutro->setIDCedula($valor);
				}
				elseif (strcasecmp($campo, "idvotante") == 0) {
					$votooutro->setIDVotante($valor);
				}
				elseif (strcasecmp($campo, "nome") == 0) {
					$votooutro->setNome($valor);
				}
				elseif (strcasecmp($campo, "voto") == 0) {
					$votooutro->setVoto($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$votooutro->setDHInclusao($valor);
				}
			}
			$resultvotooutro[] = $votooutro;
		}
		return $resultvotooutro;
	}
}
?>
