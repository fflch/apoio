<form id="formulario" action="cadtitular.php?">
<fieldset>
    <legend>
        Inclus&atilde;o de Titular
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row">
        <label for="edtpessoa" class="esquerda_maior">
            Titular
        </label>
        <input name="edtpessoa" id="edtpessoa" type="text" class="requerido maior" value="{$nome}" {$estado}/>
    </div>
    <div class="row">
      <label for="lstcargo" class="esquerda_maior">
         Cargo
      </label>
      <select name="lstcargo" id="lstcargo" class="requerido">
	     {html_options values=$opcoesidcargo output=$opcoescargo selected=$opcoescargopad}
 	    </select>
    </div>
     <div class="row">
      <label for="lstdepartamento" class="esquerda_maior">
         Departamento
      </label>
      <select name="lstdepartamento" id="lstdepartamento" class="requerido">
	     {html_options values=$opcoesidepto output=$opcoesigla selected=$opcoesdeptopad}
 	    </select>
    </div>
    <div class="row">
      <label for="lstpertence" class="esquerda_maior">
         Pertence
      </label>
      <select name="lstpertence" id="lstpertence" class="requerido">
        {html_options values=$opcoesidpertence output=$opcoespertence selected=$opcoespertencepad}
 	    </select>
    </div>
    <div class="row">
        <label for="edtinicio" class="esquerda_maior">
            In&iacute;cio
        </label>
        <input name="edtinicio" id="edtinicio" type="text" class="data requerido" value="{$inicio}"/>
    </div>
    <div class="row">
        <label for="edtermino" class="esquerda_maior">
            T&eacute;rmino
        </label>
        <input name="edtermino" id="edtermino" type="text" class="data requerido" value="{$termino}"/>
    </div>
    <div class="row">
        <label for="lststatus" class="esquerda_maior">
            Ativo
        </label>
      <select name="lststatus" id="lststatus" class="requerido">
        {html_options values=$opcoesidstatus output=$opcoestatus selected=$opcoestatuspad}
      </select>
    </div>
   <div class="row">
      <label for="edtobservacao" class="esquerda_maior">
         Observa&ccedil;&atilde;o
      </label>
      <textarea cols="53" rows="4" name="edtobservacao" id="edtobservacao" maxlength="500">{$observacao}</textarea>
   </div>
    <div class="tools">
		<button id="btnsalvar" value="#conteudo">Salvar</button>
		<button type="reset">Limpar</button>
		<input name="operacao" type="hidden" id="operacao" value="{$operacao}" />
		<input name="codigo" type="hidden" id="codigo" value="{$codigo}" />
		<input name="idpessoa" type="hidden" id="idpessoa" value="{$idpessoa}" />
		<input name="salvar" type="hidden" id="salvar" value="salvar" />
    </div>
</fieldset>
</form>
