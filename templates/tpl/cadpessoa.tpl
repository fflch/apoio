<fieldset>
  <legend>
    Inclus&atilde;o de Pessoas
  </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
  </div>
    <div id="container_abas">
      <ul id="aba_nav">
    	<li><a href="cadpessoa.php?" class="corrente">Pessoa</a></li>
    	<li><a href="cadcontato.php?operacao=inserir&">Contato</a></li>
    	<li><a href="cadtitulacao.php?operacao=inserir&">Titula&ccedil;&atilde;o</a></li>
      </ul>
      <div id="aba">
         {include file="ppessoa.tpl"}
     </div>
    </div>
</fieldset>
