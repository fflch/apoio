<div class="row" id="mensagem">
  <label for="mensagem" class="mensagem">
    {$mensagem}
  </label>
</div>
<form id="formulario" action="cadtitulacao.php?">
   <div class="row" id="titularidade">
      <label for="edtnome" class="esquerda">
         T&iacute;tulo
      </label>
      <select name="lstitulacao" id="lstitulacao" class="requerido">
	     {html_options values=$opcoesidtitulo output=$opcoestitulo selected=$opcoestitulopad}
 	  </select>
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
		<col id="Titula&ccedil;&atilde;o" />
		<col id="Status" />
		<col id="excluir" />
	  </colgroup>
	  <thead>
		<tr>
		  <th width="85%" scope="col">Titula&ccedil;&atilde;o</th>
		  <th width="10%" scope="col">Ativo</th>
  	  <th width="5%"scope="col">Excluir</th>
	 	</tr>
	  </thead>
		<tbody>
		  {section name=i loop=$titulacao}
	      <tr bgcolor="{cycle values=$cor_linha}" class="linha">
		    <td width="90%">{$titulacao[i]}</td>
		    <td width="5%" align="center">{$status[i]}</td>
		    <td width="5%" align="center">{if $status[i] != "S" } <a href="{$links_excluir[i]}" class="loadaba">
		    <img src="img/excluir.png" name="excluir" width="16" height="16" border="0" class="excluir" align="absmiddle">
		    </a>{/if}</td>
		  </tr>
		  {/section}
		</tbody>
	</table>
</form>
