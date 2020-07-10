<?php

require_once ('Loader.class.php');

class ComissaoExternaDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "comissoesexternas";

	public function __construct() {
		parent::__construct(ComissaoExternaDAOPersistivel::NOME_TABELA);
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
		$resultcargos = array();
		foreach ($resultados as $linha) {
			$comissaoexterna = new ComissaoExterna();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$comissaoexterna->setId($valor);
				}
				elseif (strcasecmp($campo, "idconcurso") == 0) {
					$comissaoexterna->setIDConcurso($valor);
				}
				elseif (strcasecmp($campo, "idcedula") == 0) {
				  $comissaoexterna->setIDCedula($valor);
				}
				elseif (strcasecmp($campo, "nome") == 0) {
					$comissaoexterna->setNome($valor);
				}
				elseif (strcasecmp($campo, "origem") == 0) {
					$comissaoexterna->setOrigem($valor);
				}
			}
			$resultcomissaoexterna[] = $comissaoexterna;
		}
		return $resultcomissaoexterna;
	}
}
?>
