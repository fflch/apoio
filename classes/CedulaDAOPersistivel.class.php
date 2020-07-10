<?php

require_once ('Loader.class.php');

class CedulaDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "cedulas";

	public function __construct() {
		parent::__construct(CedulaDAOPersistivel::NOME_TABELA);
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
		$resultcedulas = array();
		foreach ($resultados as $linha) {
			$cedula = new Cedula();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$cedula->setId($valor);
				}
				elseif (strcasecmp($campo, "tipo") == 0) {
				  $cedula->setTipo($valor);
			  }
				elseif (strcasecmp($campo, "idconcurso") == 0) {
					$cedula->setIDConcurso($valor);
				}
				elseif (strcasecmp($campo, "item") == 0) {
					$cedula->setItem($valor);
				}
				elseif (strcasecmp($campo, "pertence") == 0) {
					$cedula->setPertence($valor);
				}
				elseif (strcasecmp($campo, "descricaooutro") == 0) {
					$cedula->setDescricaoOutro($valor);
				}
				elseif (strcasecmp($campo, "pauta") == 0) {
					$cedula->setPauta($valor);
				}
				elseif (strcasecmp($campo, "data") == 0) {
					$cedula->setData($valor);
				}
				elseif (strcasecmp($campo, "branco") == 0) {
					$cedula->setQtdeBranco($valor);
				}
				elseif (strcasecmp($campo, "nulo") == 0) {
					$cedula->setQtdeNulo($valor);
				}
                                elseif (strcasecmp($campo, "votacao") == 0) {
                                        $cedula->setVotacao($valor);
                                }
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$cedula->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$cedula->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$cedula->setDHModificacao($valor);
				}
				#############################################
				elseif (strcasecmp($campo, "descricao") == 0) {
				  $cedula->setDescricao($valor);
				}
				elseif (strcasecmp($campo, "area") == 0) {
				  $cedula->setArea($valor);
				}
				elseif (strcasecmp($campo, "edital") == 0) {
				  $cedula->setEdital($valor);
				}
				elseif (strcasecmp($campo, "datapublicacao") == 0) {
				  $cedula->setDataPublicacao($valor);
				}
				elseif (strcasecmp($campo, "idpessoa") == 0) {
				  $cedula->setIDPessoa($valor);
				}
				elseif (strcasecmp($campo, "nome") == 0) {
				  $cedula->setNome($valor);
				}
				elseif (strcasecmp($campo, "instituicao") == 0) {
				  $cedula->setInstituicao($valor);
				}
				elseif (strcasecmp($campo, "titulo") == 0) {
				  $cedula->setTitulo($valor);
				}
				elseif (strcasecmp($campo, "qtdefflch") == 0) {
				  $cedula->setQtdeFFLCH($valor);
			  }
				elseif (strcasecmp($campo, "qtdefora") == 0) {
				  $cedula->setQtdeFORA($valor);
			  }
				elseif (strcasecmp($campo, "origem") == 0) {
				  $cedula->setOrigem($valor);
			  }
			  elseif (strcasecmp($campo, "idpergunta") == 0) {
			    $cedula->setIDPergunta($valor);
			  }
			  elseif (strcasecmp($campo, "pergunta") == 0) {
			    $cedula->setPergunta($valor);
			  }
			}
			$resultcedulas[] = $cedula;
		}
		return $resultcedulas;
	}
}
?>
