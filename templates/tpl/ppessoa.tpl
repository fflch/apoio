<div class="row" id="mensagem">
  <label for="mensagem" class="mensagem">
    {$mensagem}
  </label>
</div>
<form id="formulario" action="cadpessoa.php?">
   <div class="row">
      <label for="edtnusp" class="esquerda_maior">
         N&ordm; USP
      </label>
      <input name="edtnusp" id="edtnusp" type="text" maxlength="8" value="{$nusp}"/>
   </div>
   <div class="row">
      <label for="edtnome" class="esquerda_maior">
         Nome
      </label>
      <input name="edtnome" id="edtnome" type="text" class="requerido maior" maxlength="100" value="{$nome}"/>
   </div>
   <div class="row">
      <label for="edtendereco" class="esquerda_maior">
         Endere&ccedil;o
      </label>
      <input name="edtendereco" id="edtendereco" type="text" class="maior" maxlength="100" value="{$endereco}"/>
   </div>
   <div class="row">
      <label for="edtcomplemento" class="esquerda_maior">
         Complemento
      </label>
      <input name="edtcomplemento" id="edtcomplemento" type="text" class="maior" maxlength="30" value="{$complemento}"/>
   </div>
   <div class="row">
      <label for="edtcidade" class="esquerda_maior">
         Cidade
      </label>
      <input name="edtcidade" id="edtcidade" type="text" class="maior" maxlength="40" value="{$cidade}"/>
   </div>
   <div class="row">
      <label for="lstestado" class="esquerda_maior">
         Estado
      </label>
      <select name="lstestado" id="lstestado" class="requerido">
         {html_options values=$opcoesestados output=$opcoesestados selected=$opcoesestadopad}
     </select>
   </div>
   <div class="row">
       <label for="edtcep" class="esquerda_maior">
         CEP
      </label>
      <input name="edtcep" id="edtcep" type="text" maxlength="10" value="{$cep}"/>
   </div>
   <div class="row">
      <label for="lstinstituicao" class="esquerda_maior">
         Institui&ccedil;&atilde;o
      </label>
   		<select name="lstinstituicao" id="lstinstituicao">
  	      {html_options values=$opcoesinstituicao  output=$opcoesinstituicao selected=$opcoesinstituicaopad}
  		</select>
   </div>
   <div class="row">
      <label for="edtrg" class="esquerda_maior">
         RG / RNE
      </label>
      <input name="edtrg" id="edtrg" type="text"  maxlength="20" value="{$rg}"/>
   </div>
   <div class="row">
      <label for="edtpispasep" class="esquerda_maior">
         PisPasep
      </label>
      <input name="edtpispasep" id="edtpispasep" type="text" maxlength="30" value="{$pispasep}"/>
   </div>
   <div class="row">
      <label for="edtcpf" class="esquerda_maior">
         CPF
      </label>
      <input name="edtcpf" id="edtcpf" type="text" maxlength="20" value="{$cpf}"/>
   </div>
   <div class="row">
      <label for="edtpassaporte" class="esquerda_maior">
         Passaport
      </label>
      <input name="edtpassaporte" id="edtpassaporte" type="text" maxlength="30" value="{$passaporte}"/>
   </div>
   <div class="row">
      <label for="edtobservacao" class="esquerda_maior">
         Observa&ccedil;&atilde;o
      </label>
      <textarea cols="53" rows="4" name="edtobservacao" id="edtobservacao" maxlength="500">{$observacao}</textarea>
   </div>
   <div class="row">
     <label>{$datamodificacao}</label>
   </div>   
   <div class="tools">
      <button id="btnsalvar" value="#aba">Salvar</button>
      <button type="reset">Limpar</button>
      <input name="operacao" type="hidden" id="operacao" value="{$operacao}" />
      <input name="codigo" type="hidden" id="codigo" value="{$codigo}" />
      <input name="salvar" type="hidden" id="salvar" value="salvar" />
   </div>
</form>
