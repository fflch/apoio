<?php

require_once ('Loader.class.php');

class Inscrito extends Persistivel {
	private $id;
	private $idconcurso;
	private $idpessoa;
	private $processo;
	private $nota;
	private $conceito;
	private $nome;
	private $edital;
	private $descricao;
	private $status;
	private $sim;
	private $nao;
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

	public function setProcesso($processo) {
		$this->processo = $processo;
	}

  public function getProcesso() {
		return $this->processo;
	}

	public function setNota($nota) {
		$this->nota = $nota;
	}

  public function getNota() {
		return $this->nota;
	}

	public function setConceito($conceito) {
		$this->conceito = $conceito;
	}

  public function getConceito() {
		return $this->conceito;
	}

	public function setNome($nome) {
	  $this->nome = $nome;
	}

	public function getNome() {
	  return $this->nome;
	}

	public function setEdital($edital) {
	  $this->edital = $edital;
	}

	public function getEdital() {
	  return $this->edital;
	}

	public function setDescricao($descricao) {
	  $this->descricao = $descricao;
	}	

	public function getDescricao() {
	  return $this->descricao;
	}
	
	public function setStatus($status) {
	  $this->status = $status;
	}

	public function getStatus() {
	  return $this->status;
	}

	public function setSim($sim) {
	  $this->sim = $sim;
	}

	public function getSim() {
	  return $this->sim;
	}

	public function setNao($nao) {
	  $this->nao = $nao;
	}

	public function getNao() {
	  return $this->nao;
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
		return $this->getIDConcurso() . "-" . $this->getIDPessoa();
	}
}
?>
