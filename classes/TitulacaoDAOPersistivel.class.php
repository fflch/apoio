<?php

require_once ('Loader.class.php');

class TitulacaoDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "titulacoespessoas";

	public function __construct() {
		parent::__construct(TitulacaoDAOPersistivel::NOME_TABELA);
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
		$resultitulacoes = array();
		foreach ($resultados as $linha) {
			$titulacao = new Titulacao();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$titulacao->setId($valor);
				}
				elseif (strcasecmp($campo, "idtitulacao") == 0) {
					$titulacao->setIDTitulacao($valor);
				}
				elseif (strcasecmp($campo, "idpessoa") == 0) {
					$titulacao->setIDPessoa($valor);
				}
				elseif (strcasecmp($campo, "ativo") == 0) {
					$titulacao->setAtivo($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$titulacao->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$titulacao->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$titulacao->setDHModificacao($valor);
				}
				elseif (strcasecmp($campo, "titulo") == 0) {
					$titulacao->setTitulo($valor);
				}
			}
			$resultitulacoes[] = $titulacao;
		}
		return $resultitulacoes;
	}
}
?>
