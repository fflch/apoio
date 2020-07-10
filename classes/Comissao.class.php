<?php

require_once ('Loader.class.php');

class Comissao extends Persistivel {
	private $id;
	private $idconcurso;
	private $idpessoa;
	private $nome;
	private $origem;
	private $titulo;
	private $voto;
	private $idusuario;
	private $dhinclusao;
	private $dhmodificacao;

	public function setID($id) {
		$this->id = $id;
	}

	public function getID() {
		return $this->id;
	}

	public function setIDConcurso($idconcurso) {
		$this->idconcurso = $idconcurso;
	}

  public function getIDConcurso() {
		return $this->idconcurso;
	}

	public function setIDPessoa($idpessoa) {
		$this->idpessoa = $idpessoa;
	}

  public function getIDPessoa() {
		return $this->idpessoa;
	}

  public function setNome($nome) {
	  $this->nome = $nome;
	}

	public function getNome() {
	  return $this->nome;
	}

	public function setOrigem($origem) {
		$this->origem = $origem;
	}

  public function getOrigem() {
		return $this->origem;
	}

  public function setTitulo($titulo) {
    $this->titulo = $titulo;
  }

  public function getTitulo() {
    return $this->titulo;
  }

  public function setVoto($voto) {
    $this->voto = $voto;
  }

  public function getVoto() {
    return $this->voto;
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
