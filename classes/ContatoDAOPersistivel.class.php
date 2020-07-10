<?php

require_once ('Loader.class.php');

class ContatoDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "contatos";

	public function __construct() {
		parent::__construct(ContatoDAOPersistivel::NOME_TABELA);
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
		$resultcontatos = array();
		foreach ($resultados as $linha) {
			$contato = new Contato();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$contato->setId($valor);
				}
				elseif (strcasecmp($campo, "idtipocontato") == 0) {
					$contato->setIDTipocontato($valor);
				}
				elseif (strcasecmp($campo, "idpessoa") == 0) {
					$contato->setIDPessoa($valor);
				}
				elseif (strcasecmp($campo, "contato") == 0) {
					$contato->setContato($valor);
				}
				elseif (strcasecmp($campo, "tipo") == 0) {
					$contato->setTipo($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$contato->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$contato->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$contato->setDHModificacao($valor);
				}
			}
			$resultcontatos[] = $contato;
		}
		return $resultcontatos;
	}
}
?>
