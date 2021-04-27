<div class="form-row">
  <div class="form-group col-md-2">
    <label for="inicio">Início</label>
    <input type="text" class="form-control datepicker" name="inicio"
            value="{{ $contest->inicio }}">
  </div>
  <div class="form-group col-md-2">
    <label for="inicio">Término</label>
    <input type="text" class="form-control datepicker" name="termino"
            value="{{ $contest->termino }}">
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-8">
    <label for="departament_id">Departamento</label>
    <select class="form-control" name="departament_id">
      @foreach($departamentos as $id => $nome)
      @if(old('departament_id') == '' and isset($contest->departament_id))
      <option value="{{ $id }}"
      {{ ( $contest->departament_id == $id ) ? 'selected' : '' }}>
      {{ $nome }}</option>
      @else
      <option value="{{ $id }}"
      {{ ( old('departament_id') == $id ) ? 'selected' : '' }}>{{ $nome }}
      </option>
      @endif
      @endforeach
    </select>
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-8">
    <label for="titularidade">Titularidade</label>
    <input type="text" class="form-control" name="titularidade"
           value="{{ $contest->titularidade ?? old('titularidade') }}">
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-8">
    <label for="descricao">Descrição</label>
    <input type="text" class="form-control" name="descricao"
           value="{{ $contest->descricao ?? old('descricao') }}">
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-8">
    <label for="disciplina">Disciplina</label>
    <input type="text" class="form-control" name="disciplina"
           value="{{ $contest->disciplina ?? old('disciplina') }}">
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-8">
    <label for="edital">Edital</label>
    <input type="text" class="form-control" name="edital"
           value="{{ $contest->edital ?? old('edital') }}">
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-2">
    <label for="data_publicacao">Data de Publicação</label>
    <input type="text" class="form-control datepicker" name="data_publicacao"
            value="{{ $contest->data_publicacao }}">
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-4">
    <label for="processo">Processo</label>
    <input type="text" class="form-control" name="processo"
           value="{{ $contest->processo ?? old('processo') }}">
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-4">
    <label for="livro">Livro</label>
    <input type="text" class="form-control" name="livro"
           value="{{ $contest->livro ?? old('livro') }}">
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-1">
    <label for="qtde_fflch">Qtde. FFLCH</label>
    <select class="form-control" name="qtde_fflch">
       @foreach($qtdeOptions as $key => $value)
       @if(old('qtde_fflch') == '' and isset($contest->qtde_fflch))
       <option value="{{ $key }}"
         {{ ( $contest->qtde_fflch == $key ) ? 'selected' : '' }}>{{ $value }}</option>
       @elseif(old('qtde_fflch') <> '')
       <option value="{{ $key }}"
       {{ ( old('qtde_fflch') == $key ) ? 'selected' : '' }}>{{ $value }}
       </option>
       @else
       <option value="{{ $key }}"
       {{ $key == 2 ? 'selected' : '' }}>{{ $value }}
       </option>
       @endif
       @endforeach
    </select>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-1">
    <label for="qtde_externo">Qtde. Externo</label>
    <select class="form-control" name="qtde_externo">
       @foreach($qtdeOptions as $key => $value)
       @if(old('qtde_externo') == '' and isset($contest->qtde_externo))
       <option value="{{ $key }}"
         {{ ( $contest->qtde_externo == $key ) ? 'selected' : '' }}>{{ $value }}</option>
       @elseif(old('qtde_externo') <> '')
       <option value="{{ $key }}"
       {{ ( old('qtde_externo') == $key ) ? 'selected' : '' }}>{{ $value }}
       </option>
       @else
       <option value="{{ $key }}"
       {{ $key == 3 ? 'selected' : '' }}>{{ $value }}
       </option>
       @endif
       @endforeach
    </select>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-8">
    <label for="observacao">Observação</label>
    <textarea type="textarea" class="form-control" name="observacao">{{ $contest->observacao ?? old('observacao') }}</textarea>
  </div>
</div>
