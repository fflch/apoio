<form id="formulario" action="cadusuario.php?">
<fieldset>
    <legend>
        Inclus&atilde;o de Usu&aacute;rio
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row" id="nome">
        <label for="edtnome" class="esquerda">
            Nome
        </label>
        <input name="edtnome" id="edtnome" type="text" class="requerido maior" value="{$nome}"/>
    </div>
    <div class="row">
        <label for="edtlogin" class="esquerda">
            Login
        </label>
        <input name="edtlogin" id="edtlogin" type="text" class="requerido" value="{$login}"/>
    </div>
    <div class="row">
        <label for="edtsenha" class="esquerda">
            Senha
        </label>
        <input name="edtsenha" id="edtsenha" type="password" class="{$requerido}" value="{$senha}"/>
        {if $operacao eq "editar"}<span>Para alterar a senha corrente, preencha o campo com a nova senha.</span>{/if}
    </div>
    <div class="row">
        <label for="lstnivel" class="esquerda">
            N&iacute;vel
        </label>
   		<select name="lstnivel" id="lstnivel" class="requerido">
	    	{html_options values=$opcoesnivel output=$opcoesniveldescricao selected=$opcoesnivelpad}
		</select>
    </div>
	    <div class="row">
        <label for="lststatus" class="esquerda">
            Status
        </label>
		<select name="lststatus" id="lststatus" class="requerido">
	    	{html_options values=$opcoesstatus output=$opcoesstatusnome selected=$opcoesstatuspad}
    	</select>
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
