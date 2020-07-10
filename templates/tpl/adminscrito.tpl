<form id="formulario" action="{$link_consultar}">
<fieldset>
    <legend>
        Gerenciamento de Inscri&ccedil;&atilde;o
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
          {html_options values=$opcoesidcampo output=$opcoescampo selected=$opcoescampopad}
    	</select>
        <input name="edtpesquisa" id="edtpesquisa" type="text" class="requerido" value="{$campovalor}"/>
   		<button id="btnconsultar">Consultar</button>
   		<br /><br />
    <label>{$mensagem_total}</label>
		<table cellspacing="0" id="listadados">
			<colgroup>
				<col id="candidato" />
				<col id="edital" />
				<col id="recibo">
				<col id="editar" />
				<col id="excluir" />
			</colgroup>
			<thead>
				<tr>
					<th scope="col" width="50%">Candidato</th>
					<th scope="col" width="35%">Edital</th>
					<th scope="col" width="5%" >Recibo</th>
					<th scope="col" width="5%" >Alterar</th>
					<th scope="col" width="5%">Excluir</th>
				</tr>
			</thead>
			<tbody>
				{section name=i loop=$codigo}
				<tr bgcolor="{cycle values=$cor_linha}" class="linha">
					<td>{$candidato[i]}</td>
					<td>{$edital[i]}</td>
					<td align="center"><a href="{$links_recibo[i]}" class="load">
					<img src="img/recibo.png" name="editar" width="16" height="16" border="0" class="tool" align="absmiddle">
					</a></td>
					<td align="center"><a href="{$links_editar[i]}" class="load">
					<img src="img/editar.png" name="editar" width="16" height="16" border="0" class="tool" align="absmiddle">
					</a></td>
					<td align="center"><a href="{$links_excluir[i]}" class="load">
					<img src="img/excluir.png" name="excluir" width="16" height="16" border="0" class="excluir" align="absmiddle">
					</a></td>
				</tr>
				{/section}
			</tbody>
		</table>
    </div>
    <div class="row" id="pages">
      {$pages}
    </div>

</fieldset>
</form>
