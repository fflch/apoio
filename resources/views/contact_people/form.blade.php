<div class="form-group">
  <label for="tipo">Tipo</label>
  <select type="select" class="form-control" name="contact_type_id"
    id="contact_type_id">
    <option>Selecione o Tipo</option>
    <option value="1">E-mail</option>
  </select>
</div>
<div class="form-group">
  <label for="contato">Contato</label>
  <input type="text" class="form-control" name="contato" id="contato"
         value="{{ $contact->contato ?? old('contato', ) }}">
</div>
