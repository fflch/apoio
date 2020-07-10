<form id="formulario" action="cadcedula.php?">
<fieldset>
    <legend>
        Inclus&atilde;o de C&eacute;dula
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row">
        <label for="lstipo" class="esquerda_maior">
            Tipo
        </label>
        <select name="lstipo" id="lstipo" class="requerido">
          {html_options values=$opcoesidtipo output=$opcoestipo selected=$opcoestipopad}
 	      </select>
    </div>
    <div class="row lstconcurso" {if $tipo == 'O'} style="display: none;" {else} style="display: block;" {/if}>
        <label for="lstconcurso" class="esquerda_maior">
            Concurso/Edital
        </label>
        <select name="lstconcurso" id="lstconcurso" {if $tipo == 'O'} class="" {else} class="requerido" {/if}>
          {html_options values=$opcoesidconcurso output=$opcoesconcurso selected=$opcoesconcursopad}
 	      </select>
    </div>
    <div class="row">
        <label for="edtitem" class="esquerda_maior">
            Item
        </label>
        <input name="edtitem" id="edtitem" type="text" class="requerido" maxlength="5" value="{$item}"/>
    </div>
    <div class="row">
        <label for="edtpertence" class="esquerda_maior">
            Pertence
        </label>
        <select name="lstpertence" id="lstpertence" class="requerido">
          {html_options values=$opcoesidpertence output=$opcoespertence selected=$opcoespertencepad}
 	      </select>
    </div>
    <div class="row">
        <label for="edtpauta" class="esquerda_maior">
            Pauta
        </label>
        <input name="edtpauta" id="edtpauta" type="text" class="requerido" maxlength="50" value="{$pauta}"/>
    </div>
    <div class="row">
        <label for="edtdata" class="esquerda_maior">
            Data
        </label>
        <input name="edtdata" id="edtdata" type="text" class="data requerido" value="{$data}"/>
    </div>
    <div class="row cedoutrodescricao" {if $tipo != 'O'} style="display: none;" {/if} >
        <label for="edtdescricaoutro" class="esquerda_maior">
            Descri&ccedil;&atilde;o
        </label>
        <input name="edtdescricaoutro" id="edtdescricaoutro" {if $tipo == 'O'} class="requerido maior" {/if} type="text" maxlength="150" value="{$descricaoutro}"/>
    </div>
    <div class="row cedoutro" {if $tipo == 'R' || $tipo == 'O'} style="display: block;" {else} style="display: none;" {/if}>
        <label for="edtpergunta" class="esquerda_maior">
            Pergunta
        </label>
        <input name="edtpergunta" id="edtpergunta" {if $tipo == 'O' || $tipo == 'R'} class="requerido maior" {/if} type="text" maxlength="150" value="{$pergunta}"/>
    </div>
    <div class="tools">
		<button id="btnsalvar" value="#conteudo">Salvar</button>
		<button type="reset">Limpar</button>
		<input name="operacao" type="hidden" id="operacao" value="{$operacao}" />
		<input name="codigo" type="hidden" id="codigo" value="{$codigo}" />
		<input name="idpergunta" type="hidden" id="idpergunta" value="{$idpergunta}" />
		<input name="salvar" type="hidden" id="salvar" value="salvar" />
    </div>
</fieldset>
</form>
