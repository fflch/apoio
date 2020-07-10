<?php

require_once ('Loader.class.php');

class ConcursoDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "concursos";

	public function __construct() {
		parent::__construct(ConcursoDAOPersistivel::NOME_TABELA);
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
		$resultconcursos = array();
		foreach ($resultados as $linha) {
			$concursos = new Concurso();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$concursos->setId($valor);
				}
				elseif (strcasecmp($campo, "iddepartamento") == 0) {
					$concursos->setIDepartamento($valor);
				}
				elseif (strcasecmp($campo, "titularidade") == 0) {
					$concursos->setTitularidade($valor);
				}
				elseif (strcasecmp($campo, "descricao") == 0) {
					$concursos->setDescricao($valor);
				}
				elseif (strcasecmp($campo, "area") == 0) {
					$concursos->setArea($valor);
				}
				elseif (strcasecmp($campo, "disciplina") == 0) {
					$concursos->setDisciplina($valor);
				}
				elseif (strcasecmp($campo, "edital") == 0 ) {
				  $concursos->setEdital($valor);
			  }
				elseif (strcasecmp($campo, "datapublicacao") == 0 ) {
				  $concursos->setDataPublicacao($valor);
				}
				elseif (strcasecmp($campo, "inicio") == 0) {
					$concursos->setInicio($valor);
				}
				elseif (strcasecmp($campo, "termino") == 0) {
					$concursos->setTermino($valor);
				}
				elseif (strcasecmp($campo, "inicioprova") == 0) {
					$concursos->setInicioProva($valor);
				}
				elseif (strcasecmp($campo, "terminoprova") == 0) {
					$concursos->setTerminoProva($valor);
				}
				elseif (strcasecmp($campo, "processo") == 0) {
					$concursos->setProcesso($valor);
				}
				elseif (strcasecmp($campo, "livro") == 0) {
					$concursos->setLivro($valor);
				}
				elseif (strcasecmp($campo, "qtdefflch") == 0) {
					$concursos->setQtdeFFLCH($valor);
				}
				elseif (strcasecmp($campo, "qtdefora") == 0) {
					$concursos->setQtdeExterno($valor);
				}
				elseif (strcasecmp($campo, "observacao") == 0) {
					$concursos->setObservacao($valor);
				}
				elseif (strcasecmp($campo, "status") == 0) {
					$concursos->setStatus($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$concursos->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$concursos->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$concursos->setDHModificacao($valor);
				}				
				elseif (strcasecmp($campo, "sigla") == 0) {
				  $concursos->setDepto($valor);
				}
				elseif (strcasecmp($campo, "nome") == 0) {
				  $concursos->setNome($valor);
				}								
			}
			$resultconcursos[] = $concursos;
		}
		return $resultconcursos;
	}
}
?>
