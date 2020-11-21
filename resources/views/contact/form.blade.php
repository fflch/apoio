<div class="form-group">
  <label for="nome">Nome</label>
  <input type="text" class="form-control" name="nome" id="nome"
         value="{{ $contact->nome ?? old('nome') }}">
</div>
