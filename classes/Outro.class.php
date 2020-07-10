<?php

require_once ('Loader.class.php');

class Outro extends Persistivel {
	private $id;
	private $idcedula;
	private $pergunta;
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

	public function setIDCedula($idcedula) {
		$this->idcedula = $idcedula;
	}

  public function getIDCedula() {
		return $this->idcedula;
	}

	public function setPergunta($pergunta) {
	  $this->pergunta = $pergunta;
	}

	public function getPergunta() {
	  return $this->pergunta;
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
		return $this->getId();
	}
}
?>
