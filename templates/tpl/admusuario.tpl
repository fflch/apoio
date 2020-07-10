<form id="formulario" action="{$link_consultar}">
<fieldset>
    <legend>
        Gerenciamento de Usu&aacute;rio
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
			<option value="Nome">Nome</option>
			<option value="id">C&oacute;digo</option>
		</select>
        <input name="edtpesquisa" id="edtpesquisa" type="text" class="requerido"/>
   		<button id="btnconsultar">Consultar</button>
   		<br /><br />
		<table cellspacing="0" id="listadados">
			<colgroup>
				<col id="DataCadastro" />
				<col id="Descricao" />
				<col id="editar" />
				<col id="excluir" />
			</colgroup>
			<thead>
				<tr>
					<th scope="col">C&oacute;digo</th>
					<th scope="col">Nome</th>
					<th scope="col">Alterar</th>
					<th scope="col">Excluir</th>
				</tr>
			</thead>
			<tbody>
				{section name=i loop=$codigo}
				<tr bgcolor="{cycle values=$cor_linha}" class="linha">
					<td width="10%" align="center">{$codigo[i]}</td>
					<td width="80%">{$nome[i]}</td>
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
