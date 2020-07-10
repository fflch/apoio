<form id="formulario" action="{$link_consultar}">
<fieldset>
    <legend>
        Gerenciamento de Suplentes
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row" id="descricao">
        <label for="lstcampo">
            Campo
        </label>
   		<select name="lstcampo" id="lstcampo">
        {html_options values=$opcoesidcomposicao output=$opcoescomposicao selected=$opcoescomposicaopad}
		  </select>
   		<button id="btnconsultar">Consultar</button>
   		<br /><br />
   		<label>Composi&ccedil;&atilde;o {$tipo} - Total de membros = {$total} </label>
		<table cellspacing="0" id="listadados">
			<colgroup>
				<col id="Suplente" />
				<col id="Titular" />
				<col id="editar" />
				<col id="excluir" />
			</colgroup>
			<thead>
				<tr>
					<th scope="col" width="45%">Suplente</th>
					<th scope="col" width="45%">Titular</th>
					<th scope="col" Width="5%">Alterar</th>
					<th scope="col" width="5%">Excluir</th>
				</tr>
			</thead>
			<tbody>
				{section name=i loop=$codigo}
				<tr bgcolor="{cycle values=$cor_linha}" class="linha">
					<td width="45%">{$nomesuplente[i]}</td>
					<td width="45%">{$nometitular[i]}</td>
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
