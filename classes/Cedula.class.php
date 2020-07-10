<?php

require_once ('Loader.class.php');

class Cedula extends Persistivel {
	const PERTENCE_CTA = "cta";
	const PERTENCE_CONGREGRACAO = "con";

	private $id;
	private $tipo;
	private $idconcurso;
	private $item;
	private $pertence;
        private $descricaoutro;
	private $pauta;
	private $data;
	private $qtdebranco;
	private $qtdenulo;
	private $votacao;
	private $idusuario;
	private $dhinclusao;
	private $dhmodificacao;
	#variaveis de dados complementares de cédula(concurso, incrição, banca e outros)
    #concurso
	private $descricao;
	private $area;
	private $edital;
	private $datapublicacao;
	  #inscricao e banca
	private $idpessoa;
	private $nome;
	private $instituicao;
	private $titulo;
	private $qtdefflch;
	private $qtdefora;
	private $origem;
	  #outros
	private $idpergunta;
	private $pergunta;

	public function setID($id) {
		$this->id = $id;
	}

	public function getID() {
		return $this->id;
	}

  public function setTipo($tipo) {
    $this->tipo = $tipo;
  }

  public function getTipo() {
    return $this->tipo;
  }

	public function setIDConcurso($idconcurso) {
		$this->idconcurso = $idconcurso;
	}

  public function getIDConcurso() {
		return $this->idconcurso;
	}

	public function setItem($item) {
	  $this->item = $item;
	}

	public function getItem() {
	  return $this->item;
	}

	public function setPertence($pertence) {
	  $this->pertence = $pertence;
	}

	public function getPertence() {
	  return $this->pertence;
	}
 
        public function setDescricaoOutro($descricaoutro) {
          $this->descricaoutro = $descricaoutro;
        }

        public function getDescricaoOutro() {
          return $this->descricaoutro; 
        }

  public function setPauta($pauta) {
    $this->pauta = $pauta;
  }

  public function getPauta() {
    return $this->pauta;
  }

  public function setData($data) {
    $this->data = $data;
  }

  public function getData() {
    return $this->data;
  }

  public function setQtdeBranco($qtdebranco) {
    $this->qtdebranco = $qtdebranco;
  }

  public function getQtdeBranco() {
    return $this->qtdebranco;
  }

  public function setQtdeNulo($qtdenulo) {
    $this->qtdenulo = $qtdenulo;
  }

  public function getQtdeNulo() {
    return $this->qtdenulo;
  }

  public function setVotacao($votacao) {
    $this->votacao = $votacao;
  }

  public function getVotacao() {
    return $this->votacao;
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
		return $this->getId;
	}

  # metodos para obter dados complementares das cédulas (concurso, inscrição, banca e outros)

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


  public function setIDPessoa($idpessoa) {
    $this->idpessoa = $idpessoa;
  }

  public function	getIDPessoa() {
    return $this->idpessoa;
  }

  public function setNome($nome) {
    $this->nome = $nome;
  }

  public function getNome() {
    return $this->nome;
  }

  public function setInstituicao($instituicao) {
    $this->instituicao = $instituicao;
  }

  public function getInstituicao() {
    return $this->instituicao;
  }

  public function setTitulo($titulo) {
    $this->titulo = $titulo;
  }

  public function getTitulo() {
    return $this->titulo;
  }

  public function setQtdeFFLCH($qtdefflch) {
    $this->qtdefflch = $qtdefflch;
  }

  public function getQtdeFFLCH() {
    return $this->qtdefflch;
  }

  public function setQtdeFORA($qtdefora) {
    $this->qtdefora = $qtdefora;
  }

  public function getQtdeFORA() {
    return $this->qtdefora;
  }

  public function setOrigem($origem) {
    $this->origem = $origem;
  }

  public function getOrigem() {
    return $this->origem;
  }

  public function setIDPergunta($idpergunta) {
    $this->idpergunta = $idpergunta;
  }

  public function getIDPergunta() {
    return $this->idpergunta;
  }

  public function setPergunta($pergunta) {
    $this->pergunta = $pergunta;
  }

  public function getPergunta() {
    return $this->pergunta;
  }

}
?>
