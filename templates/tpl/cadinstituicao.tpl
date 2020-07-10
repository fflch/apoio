<form id="formulario" action="cadinstituicao.php?">
<fieldset>
    <legend>
        Inclus&atilde;o de Institui&ccedil;&otilde;es
    </legend>
	  <div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row">
      <label for="edtsigla" class="esquerda">
         Sigla
      </label>
        <input name="edtsigla" id="edtsigla" type="text" class="requerido" maxlength="50" value="{$sigla}"/>
    </div>
    <div class="row">
        <label for="edtinstituicao" class="esquerda">
            Institui&ccedil;&atilde;o
        </label>
        <input name="edtinstituicao" id="edtinstituicao" type="text" class="requerido maior" maxlength="100" value="{$instituicao}"/>
    </div>
    <div class="row">
        <label for="edtunidade" class="esquerda">
            Unidade
        </label>
        <input name="edtunidade" id="edtunidade" type="text" class="requerido maior" maxlength="100" value="{$unidade}"/>
    </div>
    <div class="row">
        <label for="edtlocal" class="esquerda">
            Local
        </label>
        <input name="edtlocal" id="edtlocal" type="text" class="requerido maior" maxlength="100" value="{$local}"/>
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
