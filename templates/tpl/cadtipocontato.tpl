<form id="formulario" action="cadtipocontato.php?">
<fieldset>
    <legend>
        Inclus&atilde;o de Tipo de Contato
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row">
        <label for="edtipo" class="esquerda">
            Tipo
        </label>
        <input name="edtipo" id="edtipo" type="text" class="requerido" maxlength="100" value="{$tipo}"/>
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
