<form id="formulario" action="cadcargo.php?">
<fieldset>
    <legend>
        Inclus&atilde;o de Cargo
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row">
        <label for="edtcargo" class="esquerda">
            Cargo
        </label>
        <input name="edtcargo" id="edtcargo" type="text" maxlength="100" class="requerido maior" value="{$cargo}"/>
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
