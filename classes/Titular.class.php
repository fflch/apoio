<?php

require_once ('Loader.class.php');

class Titular extends Persistivel {
  const STATUS_ATIVO = "A";
	const STATUS_INATIVO = "I";
	const PERTENCE_CTA = "cta";
	const PERTENCE_CONGREGRACAO = "con";

	private $id;
  private $idpessoa;
  private $nome;
  private $idcargo;
  private $cargo;
  private $idepto;
  private $pertence;
  private $inicio;
  private $termino;
  private $ativo;
  private $observacao;
	private $idusuario;
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

  public function setNome($nome) {
    $this->nome = $nome;
  }

  public function getNome() {
    return $this->nome;
  }

  public function setIDCargo($idcargo) {
    $this->idcargo = $idcargo;
  }

	public function getIDCargo() {
	  return $this->idcargo;
	}

	public function setCargo($cargo) {
	  $this->cargo = $cargo;
	}

	public function getCargo() {
	  return $this->cargo;
	}

  public function setIDEpto($idepto) {
    $this->idepto = $idepto;
  }

  public function getIDEpto() {
    return $this->idepto;
  }

  public function setPertence($pertence) {
    $this->pertence = $pertence;
  }

  public function getPertence() {
    return $this->pertence;
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

  public function setAtivo($ativo) {
    $this->ativo = $ativo;
  }

  public function getAtivo() {
    return $this->ativo;
  }

  public function setObservacao($observacao) {
    $this->observacao = $observacao;
  }

  public function getObservacao() {
    return $this->observacao;
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
