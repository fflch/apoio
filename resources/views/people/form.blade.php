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
  <div class="form-group col-md-4">
    <label for="designation_id">Título</label>
    <select type="select" class="form-control" name="designation_id"
           id="designation_id">
           @foreach($designations as $id => $nome)
           @if(old('designation_id') == '' and isset($people->designation_id))
           <option value="{{ $id }}"
           {{ ( $people->designation_id == $id ) ? 'selected' : '' }}>
           {{ $nome }}</option>
           @else
           <option value="{{ $id }}"
           {{ ( old('designation_id') == $id ) ? 'selected' : '' }}>{{ $nome }}
           </option>
           @endif
           @endforeach
    </select>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="institution_id">Instituição</label>
    <select type="select" class="form-control"
                          name="institution_id" id="institution_id">
           @foreach($institutions as $id => $nome)
           @if(old('institution_id') == '' and isset($people->institution_id))
           <option value="{{ $id }}"
           {{ ( $people->institution_id == $id ) ? 'selected' : '' }}>
           {{ $nome }}</option>
           @else
           <option value="{{ $id }}"
           {{ ( old('institution_id') == $id ) ? 'selected' : '' }}>{{ $nome }}
           </option>
           @endif
           @endforeach
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
    <label for="estado">Estado</label>
    <select type="select" class="form-control" name="estado" id="estado">
      <option value="">Selecione...</option>
      @foreach($estados as $key => $value)
      @if(old('estado') == '' and isset($people->estado))
      <option value="{{ $key }}"
      {{ ( $people->estado == $key ) ? 'selected' : '' }}>{{ $value }}</option>
      @else
      <option value="{{ $key }}"
      {{ ( old('estado') == $key ) ? 'selected' : '' }}>{{ $value }}
      </option>
      @endif
      @endforeach
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
    <div id="contact-div">

    @foreach (old('contato_tipo', $people->contacts->count() ? $people->contacts :
    ['']) as $people_contact)

      <div class="row" id="contact{{ $loop->index }}">
        <div class="col-sm">
          <div class="form-group">
            <label for="contato_tipo">Tipo</label>
            <select name="contato_tipo[]" class="form-control">

             @foreach($contacts as $id => $nome)
             <option value="{{ $id }}"
             @if (old('contato_tipo.' . $loop->parent->index,
             optional($people_contact)->id) == $id) selected @endif>{{ $nome }}
             </option>
             @endforeach
            </select>
          </div>
        </div>
        <div class="col-sm">
          <div class="form-group">
            <label for="contato">Contato</label>
            <input type="text" class="form-control"
                   name="contato[]"
                   value="{{ old('contato.' . $loop->index) ??
                   optional(optional($people_contact)->pivot)->contato }}">

          </div>
        </div>
      </div>
    @endforeach

      <div class="row contato" id="contact{{count(
          old('contato_tipo', $people->contacts->count() ? $people->contacts :
          [''])) }}">
      </div>

    </div>

    <div class="row">
      <div class="col-md-12">
        <button id="add_row"
                class="btn btn-primary">+ Adicione Linha</button>
        <button id='delete_row'
                class="btn btn-danger">- Excluir Linha</button>
      </div>
    </div>

  </div>
</div>
