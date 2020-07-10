<?php

require_once ('Loader.class.php');

class Titulacao extends Persistivel {
	private $id;
	private $idtitulacao;
	private $idpessoa;
	private $ativo;
	private $idusuario;
	private $dhinclusao;
	private $dhmodificacao;
	private $titulo;

	public function setID($id) {
		$this->id = $id;
	}

	public function getID() {
		return $this->id;
	}

	public function setIDTitulacao($idtitulacao) {
		$this->idtitulacao = $idtitulacao;
	}

  public function getIDTitulacao() {
		return $this->idtitulacao;
	}

	public function setIDPessoa($idpessoa) {
		$this->idpessoa = $idpessoa;
	}

  public function getIDPessoa() {
		return $this->idpessoa;
	}

	public function setAtivo($ativo) {
	  $this->ativo = $ativo;
	}

	public function getAtivo() {
	  return $this->ativo;
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

  public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}

  public function getTitulo() {
		return $this->titulo;
	}

	public function getChavePrimaria() {
		return $this->getId();
	}
}
?>
