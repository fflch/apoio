<?php

require_once ('Loader.class.php');

class FiltroSQL {
	private $conector;
	private $operador;
	private $camposFiltro;
	private $camposOrdem;
	const CONECTOR_E = 'AND';
	const CONECTOR_OU = 'OR';
	const OPERADOR_ENTRE = 'BETWEEN';
	const OPERADOR_EM = 'IN';
	const OPERADOR_CONTEM = 'LIKE';
	const OPERADOR_MAIOR = '>';
	const OPERADOR_MENOR = '<';
	const OPERADOR_MAIOR_IGUAL = '>=';
	const OPERADOR_MENOR_IGUAL = '<=';
	const OPERADOR_IGUAL = '=';
	const OPERADOR_DIFERENTE = '<>';
	const OPERADOR_META_PIPE = '|';
	const OPERADOR_META_DOIS_PONTOS = ':';
	const OPERADOR_META_ASTERISCO = '*';

	public function __construct($conector, $operador, $camposFiltro) {
		$this->setConector($conector);
		$this->setOperador($operador);
		$this->setCamposFiltro($camposFiltro);
	}

	public function setConector($conector) {
		$this->conector = $conector;
	}

	public function getConector() {
		return $this->conector;
	}

	public function setOperador($operador) {
		$this->operador = $operador;
	}

	public function getOperador() {
		return $this->operador;
	}

	public function setCamposFiltro($camposFiltro) {
		$this->camposFiltro = $camposFiltro;
	}

	public function getCamposFiltro() {
		return $this->camposFiltro;
	}

	public function adicionaCampoFiltro($campo, $valor) {
		$this->camposFiltro[$campo] = $valor;
	}

	public function removeCampoFiltro($campo) {
		unset($this->camposFiltro[$campo]);
	}

	public function retornaValorCampo($campo) {
		return $this->camposFiltro[$campo];
	}
}
?>
