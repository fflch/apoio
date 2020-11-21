<div class="form-group">
  <label for="departamento_id">Departamento</label>
  <select class="form-control" name="departament_id" id="departament_id">
    @foreach($departamentos as $id => $nome)
    @if(old('departament_id') == '' and isset($area->departament_id))
    <option value="{{ $id }}"
    {{ ( $area->departament_id == $id ) ? 'selected' : '' }}>
    {{ $nome }}</option>
    @else
    <option value="{{ $id }}"
    {{ ( old('departament_id') == $id ) ? 'selected' : '' }}>{{ $nome }}
    </option>
    @endif
    @endforeach
  </select>
</div>

<div class="form-group">
  <label for="nome">Área</label>
  <input type="text" class="form-control" name="nome" id="nome"
         value="{{ $area->nome ?? old('nome') }}">
</div>
