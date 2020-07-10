<?php

require_once ('Loader.class.php');

class PessoaDAOPersistivel extends DAOPersistivel {
	const NOME_TABELA = "pessoas";

	public function __construct() {
		parent::__construct(PessoaDAOPersistivel::NOME_TABELA);
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
		$resultpessoas = array();
		foreach ($resultados as $linha) {
			$pessoa = new Pessoa();
			foreach ($linha as $campo => $valor) {
				if (strcasecmp($campo, "id") == 0) {
					$pessoa->setId($valor);
				}
#				elseif (strcasecmp($campo, "unidade") == 0) {
#					$pessoa->setUnidade($valor);
#				}
				elseif (strcasecmp($campo, "iddepartamento") == 0) {
					$pessoa->setIDepartamento($valor);
				}
				elseif (strcasecmp($campo, "nusp") == 0) {
					$pessoa->setNUsp($valor);
				}
				elseif (strcasecmp($campo, "nome") == 0) {
					$pessoa->setNome($valor);
				}
				elseif (strcasecmp($campo, "endereco") == 0) {
					$pessoa->setEndereco($valor);
				}
				elseif (strcasecmp($campo, "complemento") == 0) {
					$pessoa->setComplemento($valor);
				}
				elseif (strcasecmp($campo, "cidade") == 0) {
					$pessoa->setCidade($valor);
				}
				elseif (strcasecmp($campo, "estado") == 0) {
					$pessoa->setEstado($valor);
				}
				elseif (strcasecmp($campo, "cep") == 0) {
					$pessoa->setCEP($valor);
				}
				elseif (strcasecmp($campo, "instituicao") == 0) {
					$pessoa->setInstituicao($valor);
				}
				elseif (strcasecmp($campo, "rg") == 0) {
					$pessoa->setRG($valor);
				}
				elseif (strcasecmp($campo, "pispasep") == 0) {
					$pessoa->setPispasep($valor);
				}
				elseif (strcasecmp($campo, "cpf") == 0) {
					$pessoa->setCPF($valor);
				}
				elseif (strcasecmp($campo, "passaporte") == 0) {
					$pessoa->setPassaport($valor);
				}
				elseif (strcasecmp($campo, "observacao") == 0) {
					$pessoa->setObservacao($valor);
				}
				elseif (strcasecmp($campo, "idusuario") == 0) {
					$pessoa->setIDUsuario($valor);
				}
				elseif (strcasecmp($campo, "dhinclusao") == 0) {
					$pessoa->setDHInclusao($valor);
				}
				elseif (strcasecmp($campo, "dhmodificacao") == 0) {
					$pessoa->setDHModificacao($valor);
				}
			}
			$resultpessoas[] = $pessoa;
		}
		return $resultpessoas;
	}
}
?>
