<?php

require_once ('Loader.class.php');

class ComissaoExterna extends Persistivel {
	private $id;
	private $idconcurso;
	private $idcedula;
	private $nome;
	private $origem;


	public function setID($id) {
		$this->id = $id;
	}

	public function getID() {
		return $this->id;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}

  public function getNome() {
		return $this->nome;
	}

	public function setIDConcurso($idconcurso) {
	  $this->idconcurso = $idconcurso;
	}

	public function getIDConcurso() {
	  return $this->idconcurso;
	}

	public function setIDCedula($idcedula) {
	  $this->idcedula = $idcedula;
	}

	public function getIDCedula() {
	  return $this->idcedula;
	}

	public function setNome($nome) {
	  $this->nome = $nome;
	}

	public function getNome(){
	  return $this->nome;
	}

	public function setOrigem($origem) {
	  $this->origem = $origem;
	}

	public function getOrigem() {
	  return $this->origem;
	}

	public function getChavePrimaria() {
		return $this->getId();
	}
}
?>
