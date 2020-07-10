<form id="formulario" action="cadtitulo.php?">
<fieldset>
    <legend>
        Inclus&atilde;o de T&iacute;tulo
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row">
        <label for="edtitulo" class="esquerda">
            T&iacute;tulo
        </label>
        <input name="edtitulo" id="edtitulo" type="text" class="requerido" maxlength="50" value="{$titulo}"/>
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
