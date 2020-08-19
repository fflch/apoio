<div class="form-group row">
  <label for="titulo" class="col-sm-2 col-form-label">Título</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" name="titulo" id="titulo"
           value="{{ $designation->titulo ?? old('titulo') }}">
  </div>
</div>

<div class="">
  <button type="submit" class="btn btn-primary">Enviar</button>
</div>
