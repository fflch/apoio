<div class="form-group row">
  <label for="sigla" class="col-sm-2 col-form-label">Sigla</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" name="sigla" id="sigla"
           value="{{ $institution->sigla ?? old('sigla', ) }}">
  </div>
</div>

<div class="form-group row">
  <label for="nome" class="col-sm-2 col-form-label">Nome</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" name="nome" id="nome"
           value="{{ $institution->nome ?? old('nome') }}">
  </div>
</div>

<div class="form-group row">
  <label for="unidade" class="col-sm-2 col-form-label">Unidade</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" name="unidade" id="unidade"
           value="{{ $institution->unidade ?? old('unidade') }}">
  </div>
</div>

<div class="form-group row">
  <label for="local" class="col-sm-2 col-form-label">Local</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" name="local" id="local"
           value="{{ $institution->local ?? old('local') }}">
  </div>
</div>

<div class="">
  <button type="submit" class="btn btn-primary">Enviar</button>
</div>
