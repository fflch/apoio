<form id="formulario" action="cadresultado.php?">
<fieldset>
    <legend>
        Inclus&atilde;o de Resultado
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
  </div>
  {if $total > 0}
    <div class="row">
        <label for="edtconcurso" class="esquerda">
            Concurso
        </label>
        <input name="edtconcurso" id="edtconcurso" type="text" class="maior" disabled value="{$descricao}"/>
    </div>
    <br /><br />
	<table cellspacing="0" id="listadados">
	<colgroup>
	  <col id="candidato" />
	  <col id="nota" />
	  <col id="conceito">
    </colgroup>
	<thead>
	  <tr>
		<th scope="col" width="70%">Candidato</th>
		<th scope="col" width="5%" >Nota</th>
		<th scope="col" width="25%" >Conceito</th>
	  </tr>
	</thead>
   	<tbody>
		{section name=i loop=$idpessoa}
		  <tr bgcolor="{cycle values=$cor_linha}">
		    <td width="70%" >{$candidato[i]}
		      <input name="idpessoa[]" type="hidden" value="{$idpessoa[i]}" />
		      <input name="idusuario[]" type="hidden" value="{$idusuario}" />
		    </td>
		    <td width="5%">
		      <input name="edtnota[]" type="text" size="1em" class="numero" value="{$nota[i]}" />
    	  </td>
       <td width="25%">
      		<select name="lstconceito[]" class="requerido">
  	        {html_options values=$opcoesconceito output=$opcoesconceito selected=$opcoesconceitopad[i]}
	  	    </select>
       </td>
		  </tr>
    {/section}
    </tbody>
	 </table>
    <div class="tools">
		<button id="btnsalvar" value="#conteudo">Salvar</button>
		<button type="reset">Limpar</button>
		<input name="operacao" type="hidden" id="operacao" value="{$operacao}" />
		<input name="codigo" type="hidden" id="codigo" value="{$codigo}" />
		<input name="salvar" type="hidden" id="salvar" value="salvar" />
    </div>
   {/if}
</fieldset>
</form>
