<fieldset>
  <legend>
    Inclus&atilde;o de Concurso
  </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
  </div>
    <div id="container_abas">
      <ul id="aba_nav">
     	  <li><a href="cadconcurso.php?" class="corrente">Concurso</a></li>
      	<li><a href="cadcomissao.php?operacao=inserir&">Comiss&atilde;o</a></li>
      	<li><a href="cadresultado.php?operacao=editar&">Resultado</a></li>      	
      </ul>
      <div id="aba">
         {include file="pconcurso.tpl"}
      </div>
    </div>
</fieldset>
