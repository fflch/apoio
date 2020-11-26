<div class="form-row">
  <div class="form-group col-md-2">
    <label for="nusp">Número USP</label>
    <input type="text" class="form-control" name="nusp" id="nusp"
           value="{{ $people->nusp ?? old('nusp', ) }}">
  </div>
  <div class="form-group col-md-6">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" name="nome" id="nome"
           value="{{ $people->nome ?? old('nome', ) }}">
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="instituicao">Instituição</label>
    <select type="select" class="form-control" name="instituicao" id="instituicao"
           value="{{ $people->instituicao ?? old('instituicao', ) }}">
      <option value="">Selecione a Instituição</option>
      <option value="SP">FFLCH</option>
    </select>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="endereco">Endereço</label>
    <input type="text" class="form-control" name="endereco" id="endereco"
           value="{{ $people->endereco ?? old('endereco', ) }}">
  </div>
  <div class="form-group col-md-6">
    <label for="complemento">Complemento</label>
    <input type="text" class="form-control" name="complemento" id="complemento"
           value="{{ $people->complemento ?? old('complemento', ) }}">
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="cidade">Cidade</label>
    <input type="text" class="form-control" name="cidade" id="cidade"
           value="{{ $people->cidade ?? old('cidade', ) }}">
  </div>
  <div class="form-group col-md-3">
    <label for="estado">UF</label>
    <select type="select" class="form-control" name="estado" id="estado"
           value="{{ $people->estado ?? old('estado', ) }}">
      <option value="">Selecione o Estado</option>
      <option value="SP">São Paulo</option>
    </select>
  </div>
  <div class="form-group col-md-3">
    <label for="cep">CEP</label>
    <input type="text" class="form-control" name="cep" id="cep"
           value="{{ $people->cep ?? old('cep', ) }}">
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-3">
    <label for="cpf">CPF</label>
    <input type="text" class="form-control" name="cpf" id="cpf"
           value="{{ $people->cpf ?? old('cpf', ) }}">
  </div>
  <div class="form-group col-md-3">
    <label for="passaport">PASSAPORT</label>
    <input type="text" class="form-control" name="passaport" id="passaport"
           value="{{ $people->passaport ?? old('passaport', ) }}">
  </div>
  <div class="form-group col-md-3">
    <label for="identidade">RG/RNE</label>
    <input type="text" class="form-control" name="identidade" id="identidade"
           value="{{ $people->identidade ?? old('identidade', ) }}">
  </div>
  <div class="form-group col-md-3">
    <label for="pispasep">PisPasep</label>
    <input type="text" class="form-control" name="pispasep" id="pispasep"
           value="{{ $people->pispasep ?? old('pispasep', ) }}">
  </div>
</div>
<div class="form-group">
  <label for="observacao">OBSERVACAO</label>
  <textarea class="form-control" name="observacao" id="observacao">{{ $people->observacao ?? old('observacao', ) }}
  </textarea>
</div>
<div class="border rounded bg-light">
  <h3 class="ml-2 mt-2">Contatos</h3>
  <div class="p-4">
    <div class="row">
      <div class="col-sm">
        <div class="form-group">
          <label for="contacts">Tipo</label>
          <select name="contacts[]" class="form-control">
            <option value="">Selecione o Contato...</option>
            <option value="1">E-mail</option>
          </select>
        </div>
      </div>
      <div class="col-sm">
        <div class="form-group">
          <label for="contato">Contato</label>
          <input type="text" class="form-control"
                 name="contato" id="contato"
                 value="{{ $people->passaport ?? old('passaport', ) }}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <button id="add_row"
                class="btn btn-default pull-left">+ Add Row</button>
        <button id='delete_row'
                class="pull-right btn btn-danger">- Delete Row</button>
      </div>
    </div>
  </div>
</div>
