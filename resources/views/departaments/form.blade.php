<div class="form-group">
  <label for="sigla">Sigla</label>
  <input type="text" class="form-control" name="sigla" id="sigla"
         value="{{ $departament->sigla ?? old('sigla', ) }}">
</div>

<div class="form-group">
  <label for="nome">Departamento</label>
  <input type="text" class="form-control" name="nome" id="nome"
         value="{{ $departament->nome ?? old('nome') }}">
</div>
