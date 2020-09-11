<div class="form-group row">
  <label for="tipo" class="col-sm-2 col-form-label">Tipo</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" name="tipo" id="tipo"
           value="{{ $contact_type->tipo ?? old('tipo') }}">
  </div>
</div>

<div class="">
  <button type="submit" class="btn btn-primary">Enviar</button>
</div>
