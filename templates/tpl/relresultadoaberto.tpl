<form id="formulario" action="{$link_consultar}" target="_blank">
<fieldset>
    <legend>
        Relat&oacute;rio de Vota&ccedil;&atilde;o
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row">
      <label class="esquerda_maior">
        Data da Vota&ccedil;&atilde;o
      </label>
  	  <input type="text" id="data" name="data" class="data requerido">
    </div>
	<div class="row">
		<label for="composicao" class="esquerda_maior">
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
