<form id="formulario" action="{$link_consultar}" target="_blank">
<fieldset>
    <legend>
        Relat&oacute;rio de Composi&ccedil;&atilde;o
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
	<div class="row" id="periodo">
		<label for="composicao">
			Composi&ccedil;&atilde;o
		</label>
 		<select name="lstcomposicao" id="lstcomposicao">
			<option value="cta">CTA</option>
			<option value="con">Congrega&ccedil;&atilde;o</option>
		</select>
		<button id="btnvisualizar">Visualizar</button>
	</div>
</fieldset>
</form>
