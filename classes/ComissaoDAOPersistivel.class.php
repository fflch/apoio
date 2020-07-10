<?php

require_once ('Loader.class.php');

class ComissaoDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "comissoes";

	public function __construct() {
		parent::__construct(ComissaoDAOPersistivel::NOME_TABELA);
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
		$resultcomissao = array();
		foreach ($resultados as $linha) {
			$comissao = new Comissao();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$comissao->setId($valor);
				}
				elseif (strcasecmp($campo, "idconcurso") == 0) {
					$comissao->setIDConcurso($valor);
				}
  			elseif (strcasecmp($campo, "idpessoa") == 0) {
					$comissao->setIDPessoa($valor);
				}
				elseif (strcasecmp($campo, "nome") == 0 ) {
				  $comissao->setNome($valor);
				}
				elseif (strcasecmp($campo, "origem") == 0) {
					$comissao->setOrigem($valor);
				}
				elseif (strcasecmp($campo, "titulo") == 0) {
					$comissao->setTitulo($valor);
				}
				elseif (strcasecmp($campo, "voto") == 0) {
					$comissao->setVoto($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$comissao->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$comissao->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$comissao->setDHModificacao($valor);
				}
			}
			$resultcomissao[] = $comissao;
		}
		return $resultcomissao;
	}
}
?>
