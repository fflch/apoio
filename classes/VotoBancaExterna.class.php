<?php

require_once ('Loader.class.php');

class VotoBancaExterna extends Persistivel {
	private $idcedula;
  private $idvotante;
  private $nome;
  private $idpessoacomissao;
  private $dhinclusao;

	public function setIDCedula($idcedula) {
		$this->idcedula = $idcedula;
	}

	public function getIDCedula() {
		return $this->idcedula;
	}

	public function setIDVotante($idvotante) {
		$this->idvotante = $idvotante;
	}

  public function getIDVotante() {
		return $this->idvotante;
	}

	public function setNome($nome) {
	  $this->nome = $nome;
	}

	public function getNome() {
	  return $this->nome;
	}

  public function setIDPessoaComissao($idpessoacomissao) {
    $this->idpessoacomissao = $idpessoacomissao;
  }

  public function getIDPessoaComissao() {
    return $this->idpessoacomissao;
  }

	public function setDHInclusao($dhinclusao) {
	  $this->dhinclusao = $dhinclusao;
	}

	public function getDHInclusao(){
	  return $this->dhinclusao;
	}

	public function getChavePrimaria() {
		return $this->getId();
	}
}
?>
