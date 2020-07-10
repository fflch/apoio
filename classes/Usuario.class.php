<?php

require_once ('Loader.class.php');

class Usuario extends Persistivel {
  const STATUS_ATIVO = "A";
	const STATUS_INATIVO = "I";
	const NIVEL_ADMINISTRADOR = "admin";
	const NIVEL_USUARIO = "usuario";


	private $id;
	private $login;
	private $senha;
	private $nome;
	private $status;
	private $nivel;
  private $idusuario;
  private $dhinclusao;
  private $dhmodificacao;

	public function setID($id) {
		$this->id = $id;
	}

	public function getID() {
		return $this->id;
	}

	public function setLogin($login) {
		$this->login = $login;
	}

    public function getLogin() {
		return $this->login;
	}

	public function setSenha($senha) {
		$this->senha = $senha;
	}

	public function getSenha() {
		return $this->senha;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function setStatus($status) {
		$this->status = $status;
	}

	public function getStatus() {
		return $this->status;
	}

	public function setNivel($nivel) {
		$this->nivel = $nivel;
	}

	public function getNivel() {
		return $this->nivel;
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
