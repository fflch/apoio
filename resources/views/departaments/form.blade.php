<div class="form-group row">
  <label for="sigla" class="col-sm-2 col-form-label">Sigla</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" name="sigla" id="sigla"
           value="{{ $departament->sigla ?? old('sigla', ) }}">
  </div>
</div>

<div class="form-group row">
  <label for="departamento" class="col-sm-2 col-form-label">Departamento</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" name="departamento" id="departamento"
           value="{{ $departament->departamento ?? old('departamento') }}">
  </div>
</div>
