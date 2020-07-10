<?php

require_once ('Loader.class.php');

class PresencaDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "presencas";

	public function __construct() {
		parent::__construct(PresencaDAOPersistivel::NOME_TABELA);
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
		$resultpresencas = array();
		foreach ($resultados as $linha) {
			$presenca = new Presenca();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$presenca->setID($valor);
				}
				elseif (strcasecmp($campo, "idpessoa") == 0 ) {
				  $presenca->setIDPessoa($valor);
				}
				elseif (strcasecmp($campo, "nome") == 0 ) {
				  $presenca->setNome($valor);
				}
				elseif (strcasecmp($campo, "idtitular") == 0) {
					$presenca->setIDTitular($valor);
				}
				elseif (strcasecmp($campo, "idsuplente") == 0) {
					$presenca->setIDSuplente($valor);
				}
				elseif (strcasecmp($campo, "pertence") == 0 ) {
				  $presenca->setPertence($valor);
				}
				elseif (strcasecmp($campo, "data") == 0 ) {
				  $presenca->setData($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$presenca->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$presenca->setDHModificacao($valor);
				}
			}
			$resultpresencas[] = $presenca;
		}
		return $resultpresencas;
	}
}
?>
