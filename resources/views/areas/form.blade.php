<div class="form-group">
  <label for="area">Área</label>
  <input type="text" class="form-control" name="area" id="area"
         value="{{ $area->area ?? old('area') }}">
</div>

<div class="form-group">
  <label for="departamento">Departamento</label>
  <select class="form-control" name="departamento" id="departamento">
    <option value="">Selecione...</option>
  </select>
</div>
