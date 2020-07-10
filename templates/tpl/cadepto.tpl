<form id="formulario" action="cadepto.php?">
<fieldset>
    <legend>
        Inclus&atilde;o de Departamento
    </legend>
	  <div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row">
        <label for="edtsigla" class="esquerda_maior">
            Sigla
        </label>
        <input name="edtsigla" id="edtsigla" type="text" class="requerido" maxlength="10" value="{$sigla}"/>
    </div>
    <div class="row">
        <label for="edtdepto" class="esquerda_maior">
            Departamento
        </label>
        <input name="edtdepto" id="edtdepto" type="text" class="requerido maior" maxlength="100" value="{$depto}"/>
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
