<form id="formulario" action="{$link_consultar}">
<fieldset>
    <legend>
        Gerenciamento de &Aacute;rea
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row" id="descricao">
        <label for="lstdepto">
            Depto
        </label>
   		<select name="lstdepto" id="lstdepto">
  	      {html_options values=$opcoesidepto output=$opcoesigla selected=$opcoesdeptopad}
		  </select>
   		<br /><br />
		<table cellspacing="0" id="listadados">
			<colgroup>
				<col id="&Aacute;rea" />
				<col id="editar" />
				<col id="excluir" />
			</colgroup>
			<thead>
				<tr>
					<th scope="col" width="90%">&Aacute;rea</th>
					<th scope="col" Width="5%">Alterar</th>
					<th scope="col" width="5%">Excluir</th>
				</tr>
			</thead>
			<tbody>
				{section name=i loop=$codigo}
				<tr bgcolor="{cycle values=$cor_linha}" class="linha">
					<td width="90%">{$area[i]}</td>
					<td width="5%" align="center"><a href="{$links_editar[i]}" class="load">
					<img src="img/editar.png" name="editar" width="16" height="16" border="0" class="tool" align="absmiddle">
					</a></td>
					<td width="5%" align="center"><a href="{$links_excluir[i]}" class="load">
					<img src="img/excluir.png" name="excluir" width="16" height="16" border="0" class="excluir" align="absmiddle">
					</a></td>
				</tr>
				{/section}
			</tbody>
		</table>
    </div>
</fieldset>
</form>
