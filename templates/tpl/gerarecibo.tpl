<form id="formulario" action="recibo.php" target="_blank">
<fieldset>
    <legend>
        Recibo
    </legend>
	  <div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row">
      <label for="lstcargo" class="esquerda">
          Cargo
      </label>
      <select name="lstcargo" id="lstcargo" class="requerido">
	     {html_options values=$opcoesidcargo output=$opcoescargo selected=$opcoescargopad}
      </select>
    </div>
    <div class="row">
      <textarea rows="5" cols="100" id="edtexto" name="edtexto" >{$texto_doutor}</textarea>
    </div>
    <div class="row">
      <input name="material1" id="material1" type="checkbox" class="checkbox" value="material1"/>
      <label for="material1" class="ponteiro">Requerimento dirigido ao Diretor solicitando inscri&ccedil;&atilde;o</label>
    </div>
    <div class="row">
      <input name="material2" id="material2" type="checkbox" class="checkbox" value="material2"/>
      <label for="material2" class="ponteiro">Dez c&oacute;pias de Memorial circunstanciado e documenta&ccedil;&atilde;o comprobat&oacute;ria</label>
    </div>
    <div class="row">
      <input name="material3" id="material3" type="checkbox" class="checkbox" value="material3"/>
      <label for="material3" class="ponteiro">Comprovante de t&iacute;tulo de Doutor; outorgado ou reconhecido pela USP ou de validade Nacional</label>
    </div>
    <div class="row">
      <input name="material4" id="material4" type="checkbox" class="checkbox" value="material4"/>
      <label for="material4" class="ponteiro">Prova de quita&ccedil;&atilde;o com o servi&ccedil;o militar para candidatos do sexo masculino</label>
    </div>
    <div class="row">
      <input name="material5" id="material5" type="checkbox" class="checkbox" value="material5"/>
      <label for="material5" class="ponteiro">T&iacute;tulo de Eleitor e comprovante da vota&ccedil;&atildeo na &uacute;ltima elei&ccedil;&atilde;o, prova de pagamento da
                               respectiva multa ou a devida justificativa</label>
    </div>
    <div class="row">
      <input name="material6" id="material6" type="checkbox" class="checkbox" value="material6"/>
      <label for="material6" class="ponteiro">Portaria FFLCH n&ordm; 008/2017 e declara&ccedil;&atilde;o de uso de computador</label>
    </div>
    <div class="row">
      <input name="material7" id="material7" type="checkbox" class="checkbox" value="material7"/>
      <label for="material7" class="ponteiro">Atestado Pr&oacute;-Libras emitido pelo Minist&eacute;rio da Educa&ccedil;&atilde;o</label>
    </div>
    <div class="row">
      <input name="material8" id="material8" type="checkbox" class="checkbox" value="material8"/>
      <label for="material8" class="ponteiro">T&iacute;tulo de Livre-Docente outorgado pela USP ou por ela reconhecido</label>
    </div>
    <div class="row">
      <input name="material9" id="material9" type="checkbox" class="checkbox" value="material9"/>
      <label for="material9" class="ponteiro">Comprovante do T&iacute;tulo de Mestre</label>
    </div>
    <div class="row">
      <input name="material10" id="material10" type="checkbox" class="checkbox" value="material10"/>
      <label for="material10" class="ponteiro">Comprovante de situa&ccedil;&atilde;o regular no pa&iacute;s</label>
    </div>
    <div class="row">
      <input name="material11" id="material11" type="checkbox" class="checkbox" value="material11"/>
      <label for="material11" class="ponteiro">C&oacute;pia do passaporte</label>
    </div>
    <div class="row">
      <input name="material12" id="material12" type="checkbox" class="checkbox" value="material12"/>
      <label for="material12" class="ponteiro">Data de postagem</label>&#32;<input name="edtdata" id="edtdata" type="text" class="data" value="{$data}"/>
    </div>    
    <div class="row">
      <input name="material13" id="material13" type="checkbox" class="checkbox" value="material13"/>
      <label for="material13" class="ponteiro">Documento de Identidade (RG ou CNH)</label>
    </div>
    <div class="row">
      <input name="material14" id="material14" type="checkbox" class="checkbox" value="material14"/>
      <label for="material14" class="ponteiro">Procura&ccedil;&atilde;o simples</label>
    </div>
    <div class="row">
      <input name="material15" id="material15" type="checkbox" class="checkbox" value="material15"/>
      <label for="material15" class="ponteiro">10 c&oacute;pias de tese de livre-doc&ecirc;ncia</label>
    </div>    
    <div class="tools">
  		<button id="btngerarecibo" value="#conteudo">Gerar Recibo</button>
		  <button type="reset">Limpar</button>
    </div>
</fieldset>
</form>
