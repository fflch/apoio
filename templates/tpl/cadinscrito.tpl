<fieldset>
<form id="formulario" action="cadinscrito.php?">
    <legend>
        Inclus&atilde;o de Inscri&ccedil;&atilde;o
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row">
      <label for="lstconcurso" class="esquerda_maior">
          Edital
      </label>
      <select name="lstconcurso" id="lstconcurso" class="requerido">
	     {html_options values=$opcoesidconcurso output=$opcoesconcurso selected=$opcoesconcursopad}
      </select>
    </div>
    <div class="row">
      <label for="edtpessoa" class="esquerda_maior">
          Candidato
      </label>
      <input name="edtpessoa" id="edtpessoa" type="text" class="requerido maior" value="{$nome}" {if $operacao eq "editar"} disabled {/if} />
    </div>
    <div class="row">
      <label for="edtprocesso" class="esquerda_maior">
          Processo
      </label>
      <input name="edtprocesso" id="edtprocesso" type="text" maxlength="30" value="{$processo}"/>
    </div>
    <div class="tools">
	    <button id="btnsalvar" value="#conteudo">Salvar</button>
		<button type="reset">Limpar</button>
		<input name="operacao" type="hidden" id="operacao" value="{$operacao}" />
		<input name="codigo" type="hidden" id="codigo" value="{$codigo}" />
		<input name="idpessoa" type="hidden" id="idpessoa" value="{$idpessoa}" />
		<input name="salvar" type="hidden" id="salvar" value="salvar" />
    </div>
</form>
</fieldset>
