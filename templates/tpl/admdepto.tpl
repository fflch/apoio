<form id="formulario" action="{$link_consultar}">
<fieldset>
    <legend>
        Gerenciamento de Departamentos
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
			<option value="sigla">Sigla</option>
			<option value="depto">Departamento</option>
		</select>
        <input name="edtpesquisa" id="edtpesquisa" type="text" class="requerido"/>
   		<button id="btnconsultar">Consultar</button>
   		<br /><br />
		<table cellspacing="0" id="listadados">
			<colgroup>
				<col id="sigla" />
				<col id="depto" />
				<col id="editar" />
				<col id="excluir" />
			</colgroup>
			<thead>
				<tr>
					<th scope="col">Sigla</th>
					<th scope="col">Depto</th>
					<th scope="col">Alterar</th>
					<th scope="col">Excluir</th>
				</tr>
			</thead>
			<tbody>
				{section name=i loop=$codigo}
				<tr bgcolor="{cycle values=$cor_linha}" class="linha">
					<td width="15%">{$sigla[i]}</td>
					<td width="75%">{$depto[i]}</td>
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
