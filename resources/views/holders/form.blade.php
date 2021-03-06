<div class="form-row">
  <div class="form-group col-md-8">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" name="nome" id="nome"
           value="{{ $holder->people->nome ?? '' }}" @if($readyonly) disabled
           @endif>
    <input type="hidden" name="people_id" id="people_id" value="{{ $holder->id }}">
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-8">
    <label for="designation_id">Cargo</label>
    <select class="form-control" name="designation_id" id="designation_id">
      <option value="">Selecione</option>
      @foreach($designations as $id => $nome)
      @if(old('designation_id') == '' and isset($holder->designation_id))
      <option value="{{ $id }}"
      {{ ( $holder->designation_id == $id ) ? 'selected' : '' }}>
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
  <div class="form-group col-md-4">
    <label for="departament_id">Departamento</label>
    <select class="form-control" name="departament_id" id="departament_id">
      <option value="">Selecione</option>
      @foreach($departamentos as $id => $nome)
      @if(old('departament_id') == '' and isset($holder->departament_id))
      <option value="{{ $id }}"
      {{ ( $holder->departament_id == $id ) ? 'selected' : '' }}>
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
  <div class="form-group col-md-4">
    <label for="pertence">Pertence</label>
    <select class="form-control" name="pertence" id="pertence">
       @foreach($pertenceOptions as $key => $value)
       @if(old('pertence') == '' and isset($holder->pertence))
       <option value="{{ $key }}"
         {{ ( $holder->pertence == $key ) ? 'selected' : '' }}>{{ $value }}</option>
       @else
       <option value="{{ $key }}"
       {{ ( old('pertence') == $key ) ? 'selected' : '' }}>{{ $value }}
       </option>
       @endif
       @endforeach
    </select>
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-2">
    <label for="inicio">Início</label>
    <input type="text" class="form-control datepicker" name="inicio" id="inicio"
            value="{{ $holder->inicio }}">
  </div>
  <div class="form-group col-md-2">
    <label for="inicio">Término</label>
    <input type="text" class="form-control datepicker" name="termino" id="termino"
            value="{{ $holder->termino }}">
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-2">
    <label for="status">Status</label>
    <select class="form-control" name="status" id="status">
       @foreach($statusOptions as $key => $value)
       @if(old('status') == '' and isset($holder->status))
       <option value="{{ $key }}"
         {{ ( $holder->status == $key ) ? 'selected' : '' }}>{{ $value }}</option>
       @else
       <option value="{{ $key }}"
       {{ ( old('status') == $key ) ? 'selected' : '' }}>{{ $value }}
       </option>
       @endif
       @endforeach
    </select>
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-8">
    <label for="observacao">Observação</label>
    <textarea class="form-control" name="observacao" id="observacao">{{
      $holder->observacao }}
    </textarea>
  </div>
</div>
