<div class="form-group">
  <label for="nusp">Número USP</label>
  <input type="text" class="form-control" name="nusp" id="nusp"
         value="{{ $people->nusp ?? old('nusp', ) }}">
</div>
<div class="form-group">
  <label for="nome">Nome</label>
  <input type="text" class="form-control" name="nome" id="nome"
         value="{{ $people->nome ?? old('nome', ) }}">
</div>
<div class="form-group">
  <label for="endereco">Endereço</label>
  <input type="text" class="form-control" name="endereco" id="endereco"
         value="{{ $people->endereco ?? old('endereco', ) }}">
</div>
<div class="form-group">
  <label for="complemento">Complemento</label>
  <input type="text" class="form-control" name="complemento" id="complemento"
         value="{{ $people->complemento ?? old('complemento', ) }}">
</div>

<div class="form-group">
  <label for="cidade">Cidade</label>
  <input type="text" class="form-control" name="cidade" id="cidade"
         value="{{ $people->cidade ?? old('cidade', ) }}">
</div>

<div class="form-group">
  <label for="estado">UF</label>
  <select type="select" class="form-control" name="estado" id="estado"
         value="{{ $people->estado ?? old('estado', ) }}">
    <option value="">Selecione o Estado</option>
    <option value="SP">São Paulo</option>
  </select>
</div>

<div class="form-group">
  <label for="cep">CEP</label>
  <input type="text" class="form-control" name="cep" id="cep"
         value="{{ $people->cep ?? old('cep', ) }}">
</div>

<div class="form-group">
  <label for="instituicao">Instituição</label>
  <select type="select" class="form-control" name="instituicao" id="instituicao"
         value="{{ $people->instituicao ?? old('instituicao', ) }}">
    <option value="">Selecione a Instituição</option>
    <option value="SP">FFLCH</option>
  </select>
</div>

<div class="form-group">
  <label for="identidade">RG/RNE</label>
  <input type="text" class="form-control" name="identidade" id="identidade"
         value="{{ $people->identidade ?? old('identidade', ) }}">
</div>
<div class="form-group">
  <label for="pispasep">PisPasep</label>
  <input type="text" class="form-control" name="pispasep" id="pispasep"
         value="{{ $people->pispasep ?? old('pispasep', ) }}">
</div>
<div class="form-group">
  <label for="cpf">CPF</label>
  <input type="text" class="form-control" name="cpf" id="cpf"
         value="{{ $people->cpf ?? old('cpf', ) }}">
</div>
<div class="form-group">
  <label for="passaport">PASSAPORT</label>
  <input type="text" class="form-control" name="passaport" id="passaport"
         value="{{ $people->passaport ?? old('passaport', ) }}">
</div>
<div class="form-group">
  <label for="observacao">OBSERVACAO</label>
  <input type="text" class="form-control" name="observacao" id="observacao"
         value="{{ $people->observacao ?? old('observacao', ) }}">
</div>
