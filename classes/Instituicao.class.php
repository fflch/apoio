<?php

require_once ('Loader.class.php');

class Instituicao extends Persistivel {
	private $id;
	private $sigla;
	private $instituicao;
	private $unidade;
	private $local;
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

	public function setInstituicao($instituicao) {
	  $this->instituicao = $instituicao;
	}

	public function getInstituicao() {
	  return $this->instituicao;
	}

  public function setUnidade($unidade) {
    $this->unidade = $unidade;
  }

	public function getUnidade() {
	  return $this->unidade;
	}

	public function setLocal($local) {
	  $this->local = $local;
	}

	public function getLocal() {
	  return $this->local;
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
