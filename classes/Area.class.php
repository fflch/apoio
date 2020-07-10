<?php

require_once ('Loader.class.php');

class Area extends Persistivel {
	private $id;
	private $idepto;
	private $area;
	private $idusuario;
	private $dhinclusao;
	private $dhmodificacao;

	public function setID($id) {
		$this->id = $id;
	}

	public function getID() {
		return $this->id;
	}

	public function setIDDepto($idepto) {
		$this->idepto = $idepto;
	}

  public function getIDDepto() {
		return $this->idepto;
	}

	public function setArea($area) {
	  $this->area = $area;
	}

	public function getArea() {
	  return $this->area;
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
