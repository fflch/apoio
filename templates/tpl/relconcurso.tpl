<form id="formulario" action="{$link_consultar}" target="_blank">
<fieldset>
    <legend>
        Relat&oacute;rio de Concursos
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
	<div class="row" id="periodo">
		<label for="lststatuscertame" class="esquerda">
			Status
		</label>
 		<select name="lststatuscertame" id="lststatuscertame">
			<option value="I">Inscri&ccedil;&atilde;o</option>
			<option value="C">Certame</option>
			<option value="E">Espera</option>
			<option value="F">Finalizados</option>
		</select>
		<div id="datacertame">
      <label>
         Data de In&iacute;cio (Certame)
      </label>
    	<input type="text" id="datainicio1" name="datainicio1" class="data">
    	<input type="text" id="datainicio2" name="datainicio2" class="data">
  	</div>
	  <button id="btnvisualizar">Visualizar</button>
	</div>
</fieldset>
</form>
