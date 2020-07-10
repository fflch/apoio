<?php

require_once ('Loader.class.php');

class Pessoa extends Persistivel {
	private $id;
# private $unidade;
	private $idepartamento;
	private $nusp;
	private $nome;
	private $endereco;
	private $complemento;
	private $cidade;
	private $estado;
	private $cep;
	private $instituicao;
	private $rg;
	private $pispasep;
	private $cpf;
	private $passaporte;
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

#	public function setUnidade($unidade) {
#		$this->unidade = $unidade;
#	}

#	public function getUnidade() {
#		return $this->unidade;
#	}

	public function setIDepartamento($idepartamento) {
		$this->idepartamento = $idepartamento;
	}

    public function getIDepartamento() {
		return $this->idepartamento;
	}

	public function setNUsp($nusp) {
		$this->nusp = $nusp;
	}

	public function getNUsp() {
		return $this->nusp;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setEndereco($endereco) {
		$this->endereco = $endereco;
	}

	public function getEndereco() {
		return $this->endereco;
	}

	public function setComplemento($complemento) {
		$this->complemento = $complemento;
	}

	public function getComplemento() {
		return $this->complemento;
	}

	public function setCidade($cidade) {
		$this->cidade = $cidade;
	}

	public function getCidade() {
		return $this->cidade;
	}

	public function setEstado($estado) {
		$this->estado = $estado;
	}

	public function getEstado() {
		return $this->estado;
	}

	public function setCEP($cep) {
		$this->cep = $cep;
	}

	public function getCEP() {
		return $this->cep;
	}

	public function setInstituicao($instituicao) {
		$this->instituicao = $instituicao;
	}

	public function getInstituicao() {
		return $this->instituicao;
	}

	public function setRG($rg) {
		$this->rg = $rg;
	}

	public function getRG() {
		return $this->rg;
	}

	public function setPispasep($pispasep) {
		$this->pispasep = $pispasep;
	}

	public function getPispasep() {
		return $this->pispasep;
	}

	public function setCPF($cpf) {
		$this->cpf = $cpf;
	}

	public function getCPF() {
		return $this->cpf;
	}

	public function setPassaport($passaporte) {
		$this->passaporte = $passaporte;
	}

	public function getPassaport() {
		return $this->passaporte;
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
