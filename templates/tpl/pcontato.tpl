<div class="row" id="mensagem">
  <label for="mensagem" class="mensagem">
    {$mensagem}
  </label>
</div>
<form id="formulario" action="cadcontato.php?">
   <div class="row">
      <label for="lstipo" class="esquerda">
        Tipo
      </label>
      <select name="lstipo" id="lstipo" class="requerido">
     	  {html_options values=$opcoesidtipo output=$opcoestipo selected=$opcoestipocontatopad}
 	  </select>
   </div>
   <div class="row">
      <label for="edtcontato" class="esquerda">
         Contato
      </label>
      <input name="edtcontato" id="edtcontato" type="text" class="requerido maior" maxlength="50" value=""/>
   </div>
   <div class="tools">
      <button id="btnsalvar" value="#aba">Salvar</button>
      <button type="reset">Limpar</button>
      <input name="operacao" type="hidden" id="operacao" value="{$operacao}" />
      <input name="codigo" type="hidden" id="codigo" value="{$codigo}" />
      <input name="salvar" type="hidden" id="salvar" value="salvar" />
   </div>
   <br /><br />
   <table cellspacing="0" id="listadados">
	  <colgroup>
		<col id="Tipo" />
		<col id="Contato" />
		<col id="excluir" />
	  </colgroup>
	  <thead>
		<tr>
		  <th width="15%" scope="col">Tipo</th>
		  <th width="90%" scope="col">Contato</th>
  	  <th width="5%" scope="col">Excluir</th>
	 	</tr>
	  </thead>
		<tbody>
		  {section name=i loop=$tipo}
	      <tr bgcolor="{cycle values=$cor_linha}" class="linha">
		    <td width="15%">{$tipo[i]}</td>
		    <td width="90%">{$contato[i]}</td>
		    <td width="5%" align="center"><a href="{$links_excluir[i]}" class="loadaba">
		    <img src="img/excluir.png" name="excluir" width="16" height="16" border="0" class="excluir" align="absmiddle">
		    </a></td>
		  </tr>
		  {/section}
		</tbody>
	</table>
</form>
