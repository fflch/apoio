<?php

require_once ('Loader.class.php');

class Suplente extends Persistivel {

	const PERTENCE_CTA = "cta";
	const PERTENCE_CONGREGRACAO = "con";
	private $id;
  private $idtitular;
  private $nometitular;
  private $cargo;
  private $idpessoa;
  private $nomesuplente;
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

  public function setIDTitular($idtitular) {
    $this->idtitular = $idtitular;
  }

	public function getIDTitular() {
	  return $this->idtitular;
	}

	public function setNomeTitular($nometitular) {
	  $this->nometitular = $nometitular;
	}

	public function getNomeTitular() {
	  return $this->nometitular;
	}

	public function setCargo($cargo) {
	  $this->cargo = $cargo;
	}

	public function getCargo() {
	  return $this->cargo;
	}

	public function setIDPessoa($idpessoa) {
		$this->idpessoa = $idpessoa;
	}

  public function getIDPessoa() {
		return $this->idpessoa;
	}

	public function setNomeSuplente($nomesuplente) {
	  $this->nomesuplente = $nomesuplente;
	}

	public function getNomeSuplente() {
	  return $this->nomesuplente;
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
