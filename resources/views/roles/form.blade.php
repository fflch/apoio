<div class="form-group row">
  <label for="cargo" class="col-sm-2 col-form-label">Cargo</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" name="cargo" id="cargo"
           value="{{ $role->cargo ?? old('cargo') }}">
  </div>
</div>

<div class="">
  <button type="submit" class="btn btn-primary">Enviar</button>
</div>
