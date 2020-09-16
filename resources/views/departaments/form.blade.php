<div class="form-group">
  <label for="sigla">Sigla</label>
  <input type="text" class="form-control" name="sigla" id="sigla"
         value="{{ $departament->sigla ?? old('sigla', ) }}">
</div>

<div class="form-group">
  <label for="departamento">Departamento</label>
  <input type="text" class="form-control" name="departamento" id="departamento"
         value="{{ $departament->departamento ?? old('departamento') }}">
</div>
