<form id="formulario" action="cadarea.php?">
<fieldset>
    <legend>
        Inclus&atilde;o de &Aacute;rea
    </legend>
	  <div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row">
      <label for="lstdepto" class="esquerda_maior">
         Departamento
      </label>
      <select name="lstidepto" id="lstidepto" class="requerido">
	     {html_options values=$opcoesdeptos_id output=$opcoesigla selected=$opcoesdeptopad}
      </select>
    </div>
    <div class="row">
        <label for="edtarea" class="esquerda_maior">
            &Aacute;rea
        </label>
        <input name="edtarea" id="edtarea" type="text" class="requerido maior" maxlength="150" value="{$area}"/>
    </div>
    <div class="tools">
		<button id="btnsalvar" value="#conteudo">Salvar</button>
		<button type="reset">Limpar</button>
		<input name="operacao" type="hidden" id="operacao" value="{$operacao}" />
		<input name="codigo" type="hidden" id="codigo" value="{$codigo}" />
		<input name="salvar" type="hidden" id="salvar" value="salvar" />
    </div>
</fieldset>
</form>
