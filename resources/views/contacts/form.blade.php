<div class="form-group">
  <label for="tipo">Tipo</label>
  <select type="select" class="form-control" name="tipo" id="tipo">
    <option>Selecione o Tipo</option>
    <option>E-mail</option>
  </select>
</div>
<div class="form-group">
  <label for="contato">Contato</label>
  <input type="text" class="form-control" name="contato" id="contato"
         value="{{ $contact->contato ?? old('contato', ) }}">
</div>
