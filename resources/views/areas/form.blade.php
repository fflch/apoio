<div class="form-group row">
  <label for="sigla" class="col-sm-2 col-form-label">Sigla</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" name="sigla" id="sigla"
           value="{{ $area->departament->sigla ?? old('sigla', ) }}">
  </div>
</div>

<div class="form-group row">
  <label for="area" class="col-sm-2 col-form-label">Departamento</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" name="area" id="area"
           value="{{ $area->area ?? old('area') }}">
  </div>
</div>

<div class="">
  <button type="submit" class="btn btn-primary">Enviar</button>
</div>
