<div class="form-row">
  <div class="form-group col-md-8">
    <label for="holder">Titular</label>
    <input type="text" class="form-control" name="holder" id="holder"
           value="{{ $surrogate->holder->people->nome ?? '' }}">
    <input type="hidden" name="holder_id" id="holder_id" value="{{
    $surrogate->holder_id }}">
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-8">
    <label for="departament">Cargo</label>
    <input type="text" class="form-control" name="designation" id="designation"
           value="{{ $surrogate->holder->designation->nome ?? '' }}" disabled>
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-8">
    <label for="nome">Suplente</label>
    <input type="text" class="form-control" name="nome" id="nome"
           value="{{ $surrogate->people->nome ?? '' }}">
    <input type="hidden" name="people_id" id="people_id" value="{{ $surrogate->id }}">
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-4">
    <label for="departament_id">Departamento</label>
    <select class="form-control" name="departament_id" id="departament_id">
      <option value="">Selecione</option>
      @foreach($departamentos as $id => $nome)
      @if(old('departament_id') == '' and isset($surrogate->departament_id))
      <option value="{{ $id }}"
      {{ ( $surrogate->departament_id == $id ) ? 'selected' : '' }}>
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
       @if(old('pertence') == '' and isset($surrogate->pertence))
       <option value="{{ $key }}"
         {{ ( $surrogate->pertence == $key ) ? 'selected' : '' }}>{{ $value }}</option>
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
            value="{{ $surrogate->inicio }}">
  </div>
  <div class="form-group col-md-2">
    <label for="inicio">Término</label>
    <input type="text" class="form-control datepicker" name="termino" id="termino"
            value="{{ $surrogate->termino }}">
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-2">
    <label for="status">Status</label>
    <select class="form-control" name="status" id="status">
       @foreach($statusOptions as $key => $value)
       @if(old('status') == '' and isset($surrogate->status))
       <option value="{{ $key }}"
         {{ ( $surrogate->status == $key ) ? 'selected' : '' }}>{{ $value }}</option>
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
      $surrogate->observacao }}
    </textarea>
  </div>
</div>
