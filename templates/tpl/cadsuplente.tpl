<form id="formulario" action="cadsuplente.php?">
<fieldset>
    <legend>
        Inclus&atilde;o de Suplente
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
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
        <label for="edtitular" class="esquerda_maior">
            Titular
        </label>
        <input name="edtitular" id="edtitular" type="text" class="requerido maior" value="{$nometitular}"/>
    </div>
    <div class="row">
        <label for="edtcargo" class="esquerda_maior">
            Cargo
        </label>
        <input name="edtcargo" id="edtcargo" type="text" class="maior" value="{$cargo}" disabled/>
    </div>
    <div class="row">
        <label for="edtpessoa" class="esquerda_maior">
            Suplente
        </label>
        <input name="edtpessoa" id="edtpessoa" type="text" class="requerido maior" value="{$nomesuplente}"/>
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
		<input name="idtitular" type="hidden" id="idtitular" value="{$idtitular}" />
		<input name="salvar" type="hidden" id="salvar" value="salvar" />
    </div>
</fieldset>
</form>
