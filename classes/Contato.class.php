<?php

require_once ('Loader.class.php');

class Contato extends Persistivel {
	private $id;
	private $idtipocontato;
	private $idpessoa;
	private $contato;
	private $tipo;
	private $idusuario;
	private $dhinclusao;
	private $dhmodificacao;

	public function setID($id) {
		$this->id = $id;
	}

	public function getID() {
		return $this->id;
	}

	public function setIDTipocontato($idtipocontato) {
		$this->idtipocontato = $idtipocontato;
	}

  public function getIDTipocontato() {
		return $this->idtipocontato;
	}

	public function setIDPessoa($idpessoa) {
		$this->idpessoa = $idpessoa;
	}

  public function getIDPessoa() {
		return $this->idpessoa;
	}

	public function setContato($contato) {
	  $this->contato = $contato;
	}

	public function getContato() {
	  return $this->contato;
	}

  public function setTipo($tipo) {
    $this->tipo = $tipo;
  }

  public function getTipo() {
    return $this->tipo;
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
