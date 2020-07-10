<div class="row" id="mensagem">
  <label for="mensagem" class="mensagem">
    {$mensagem}
  </label>
</div>
<form id="formulario" action="cadconcurso.php?">
   <div class="row" id="inicio">
      <label for="edtinicio" class="esquerda_maior">
         In&iacute;cio
      </label>
      <input name="edtinicio" id="edtinicio" type="text" class="data requerido" value="{$inicio}"/>
      <label for="edtermino" class="espaco">
         T&eacute;mino
      </label>
      <input name="edtermino" id="edtermino" type="text" class="data requerido" value="{$termino}"/>
   </div>
      <div class="row">
      <label for="lstdepartamento" class="esquerda_maior">
         Departamento
      </label>
      <select name="lstdepartamento" id="lstdepartamento" class="requerido">
	     {html_options values=$opcoesidepto output=$opcoesigla selected=$opcoesdeptopad}
 	    </select>
   </div>
   <div class="row" id="titularidade">
      <label for="edtitularidade" class="esquerda_maior">
         Titularidade
      </label>
      <input name="edtitularidade" id="edtitularidade" type="text" class="requerido maior" maxlength="30" value="{$titularidade}"/>
   </div>
   <div class="row" id="descricao">
      <label for="edtdescricao" class="esquerda_maior">
         Descri&ccedil;&atilde;o
      </label>
      <input name="edtdescricao" id="edtdescricao" type="text" class="requerido maior" maxlength="250" value="{$descricao}"/>
   </div>
   <div class="row" id="area">
      <label for="edtarea" class="esquerda_maior">
        &Aacute;rea
      </label>
      <select name="lstarea" id="lstarea" class="requerido">
	     {html_options values=$opcoesarea output=$opcoesarea selected=$opcoesareapad}
 	    </select>
   </div>
   <div class="row" id="disciplina">
      <label for="edtdisciplina" class="esquerda_maior">
         Disciplina
      </label>
      <input name="edtdisciplina" id="edtdisciplina" type="text" class="maior" maxlength="100" value="{$disciplina}"/>
   </div>

   <div class="row" id="edital">
     <label for="edtedital" class="esquerda_maior">
       Edital
     </label>
     <input name="edtedital" id="edtedital" type="text" maxlength="50" class="requerido" value="{$edital}">
     <label for="edtdtpublicacao" class="espaco">
         Data de Publica&ccedil;&atilde;o
      </label>
      <input name="edtdtpublicacao" id="edtdtpublicacao" type="text" class="data requerido" value="{$datapublicacao}"/>
   </div>

   {if $operacao == "editar" & $certame == "true" || $status == "C"}
   <div class="row" id="prova">
      <label for="edtinicioprova" class="esquerda_maior">
         In&iacute;cio Certame
      </label>
      <input name="edtinicioprova" id="edtinicioprova" type="text" class="data" value="{$inicioprova}"/>
      <label for="edterminoprova" class="espaco">
         T&eacute;mino Certame
      </label>
      <input name="edterminoprova" id="edterminoprova" type="text" class="data" value="{$terminoprova}"/>
   </div>
   {/if}
   <div class="row" id="processo">
      <label for="edtprocesso" class="esquerda_maior">
         Processo
      </label>
      <input name="edtprocesso" id="edtprocesso" type="text" class="requerido" maxlength="30" value="{$processo}"/>
   </div>
   <div class="row" id="livro">
      <label for="edtlivro" class="esquerda_maior">
         Livro
      </label>
      <input name="edtlivro" id="edtlivro" type="text" maxlength="30" value="{$livro}"/>
   </div>

    <div class="row">
        <label for="edtqtdefflch" class="esquerda_maior">
            Qtde. FFLCH
        </label>
        <select name="lstqtdefflch" id="lstqtdefflch" class="requerido">
  	      {html_options values=$opcoesidfflch output=$opcoesfflch selected=$opcoesfflchpad}
 	      </select>
    </div>
    <div class="row">
        <label for="edtqtdefora" class="esquerda_maior">
            Qtde. Externo
        </label>
        <select name="lstqtdefora" id="lstqtdefora" class="requerido">
	        {html_options values=$opcoesidfora output=$opcoesfora selected=$opcoesforapad}
 	      </select>
    </div>
   <div class="row">
      <label for="edtobservacao" class="esquerda_maior">
         Observa&ccedil;&atilde;o
      </label>
      <textarea cols="53" rows="4" name="edtobservacao" id="edtobservacao" maxlength="500" >{$observacao}</textarea>
   </div>
   <div class="tools">
      <button id="btnsalvar" value="#aba">Salvar</button>
      <button type="reset">Limpar</button>
      <input name="operacao" type="hidden" id="operacao" value="{$operacao}" />
      <input name="codigo" type="hidden" id="codigo" value="{$codigo}" />
      <input name="salvar" type="hidden" id="salvar" value="salvar" />
   </div>
</form>
