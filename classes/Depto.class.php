<?php

require_once ('Loader.class.php');

class Depto extends Persistivel {
	private $id;
	private $sigla;
	private $depto;
	private $idusuario;
	private $dhinclusao;
	private $dhmodificacao;

	public function setID($id) {
		$this->id = $id;
	}

	public function getID() {
		return $this->id;
	}

	public function setSigla($sigla) {
		$this->sigla = $sigla;
	}

    public function getSigla() {
		return $this->sigla;
	}

	public function setDepto($depto) {
		$this->depto = $depto;
	}

	public function getDepto() {
		return $this->depto;
	}

	public function setIDUsuario($idusuario) {
	  $this->idusuario = $idusuario;
	}

	public function getIDUsuario() {
	  return $this->idusuario;
	}

	public function setDHInclusao($dhinclusao) {
	  $this->dhinclusao = $dhinclusao;
	}

	public function getDHInclusao(){
	  return $this->dhinclusao;
	}

	public function setDHModificacao($dhmodificacao) {
	  $this->dhmodificacao = $dhmodificacao;
	}

	public function getDHModificacao() {
	  return $this->dhmodificacao;
	}

	public function getChavePrimaria() {
		return $this->getId();
	}
}
?>
