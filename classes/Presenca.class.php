<?php

require_once ('Loader.class.php');

class Presenca extends Persistivel {
	private $id;
	private $idpessoa;
	private $nome;
	private $idtitular;
  private $idsuplente;
  private $pertence;
  private $data;
	private $dhinclusao;
	private $dhmodificacao;

	public function setID($id) {
		$this->id = $id;
	}

	public function getID() {
		return $this->id;
	}

  public function setIDPessoa($idpessoa) {
    $this->idpessoa = $idpessoa;
  }

  public function getIDPessoa() {
    return $this->idpessoa;
  }

	public function setIDTitular($idtitular) {
		$this->idtitular = $idtitular;
	}

  public function getIDTitular() {
		return $this->idtitular;
	}

	public function setIDSuplente($idsuplente) {
	  $this->idsuplente = $idsuplente;
	}

	public function getIDSuplente() {
	  return $this->idsuplente;
	}

	public function setPertence($pertence) {
	  $this->pertence = $pertence;
	}

	public function getPertence() {
	  return $this->pertence;
	}

	public function setData($data) {
	  $this->data = $data;
	}

	public function getData() {
	  return $this->data;
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

  public function setNome($nome) {
    $this->nome = $nome;
  }

	public function getNome() {
	  return $this->nome;
	}
}
?>
