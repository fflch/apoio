<?php

require_once ('Loader.class.php');

class Concurso extends Persistivel {
	private $id;
	private $idepartamento;
	private $titularidade;
	private $descricao;
	private $area;
	private $disciplina;
	private $edital;
	private $datapublicacao;
	private $inicio;
	private $termino;
  private $inicioprova;
 	private $terminoprova;
	private $processo;
	private $livro;
	private $qtdefflch;
	private $qtdexterno;
	private $observacao;
	private $status;
	private $idusuario;
	private $dhinclusao;
	private $dhmodificacao;
	private $nome;
	private $depto;

	public function setID($id) {
		$this->id = $id;
	}

	public function getID() {
		return $this->id;
	}

	public function setIDepartamento($idepartamento) {
		$this->idepartamento = $idepartamento;
	}

  public function getIDepartamento() {
		return $this->idepartamento;
	}

	public function setTitularidade($titularidade) {
		$this->titularidade = $titularidade;
	}

  public function getTitularidade() {
		return $this->titularidade;
	}

	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}

  public function getDescricao() {
		return $this->descricao;
	}

	public function setArea($area) {
		$this->area = $area;
	}

  public function getArea() {
		return $this->area;
	}

	public function setDisciplina($disciplina) {
		$this->disciplina = $disciplina;
	}

  public function getDisciplina() {
		return $this->disciplina;
	}

	public function setEdital($edital) {
	  $this->edital = $edital;
	}

	public function getEdital() {
	  return $this->edital;
	}

	public function setDataPublicacao($datapublicacao) {
	  $this->datapublicacao = $datapublicacao;
	}

	public function getDataPublicacao() {
	  return $this->datapublicacao;
	}

	public function setInicio($inicio) {
		$this->inicio = $inicio;
	}

  public function getInicio() {
		return $this->inicio;
	}

	public function setTermino($termino) {
		$this->termino = $termino;
	}

  public function getTermino() {
		return $this->termino;
	}

	public function setInicioProva($inicioprova) {
		$this->inicioprova = $inicioprova;
	}

  public function getInicioProva() {
		return $this->inicioprova;
	}

	public function setTerminoProva($terminoprova) {
		$this->terminoprova = $terminoprova;
	}

  public function getTerminoProva() {
		return $this->terminoprova;
	}

	public function setProcesso($processo) {
		$this->processo = $processo;
	}

  public function getProcesso() {
		return $this->processo;
	}

	public function setLivro($livro) {
		$this->livro = $livro;
	}

  public function getLivro() {
		return $this->livro;
	}

  public function setQtdeFFLCH($qtdefflch) {
    $this->qtdefflch = $qtdefflch;
  }

  public function getQtdeFFLCH() {
    return $this->qtdefflch;
  }

  public function setQtdeExterno($qtdexterno) {
    $this->qtdexterno = $qtdexterno;
  }

  public function getQtdeExterno() {
    return $this->qtdexterno;
  }

	public function setObservacao($observacao) {
		$this->observacao = $observacao;
	}

  public function getObservacao() {
		return $this->observacao;
	}

	public function setStatus($status) {
		$this->status = $status;
	}

  public function getStatus() {
		return $this->status;
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
	
	public function setDepto($depto){
	  $this->depto = $depto;
	}
	
	public function getDepto(){
	  return $this->depto;
	}
	
	public function setNome($nome){
	  $this->nome = $nome; 
	}
	
	public function getNome(){
	  return $this->nome;
	}
	
}
?>
