<div class="form-group">
  <label for="departamento">Departamento</label>
  <select class="form-control" name="departament_id" id="departament_id">
    @foreach($departamentos as $id => $departamento)
    @if(old('departament_id') == '' and isset($area->departament_id))
    <option value="{{ $id }}"
    {{ ( $area->departament_id == $id ) ? 'selected' : '' }}>
    {{ $departamento }}</option>
    @else
    <option value="{{ $id }}"
    {{ ( old('departament_id') == $id ) ? 'selected' : '' }}>{{ $departamento }}
    </option>
    @endif
    @endforeach
  </select>
</div>

<div class="form-group">
  <label for="area">Área</label>
  <input type="text" class="form-control" name="area" id="area"
         value="{{ $area->area ?? old('area') }}">
</div>
