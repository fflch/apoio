<form id="formulario" action="{$link_consultar}">
<fieldset>
    <legend>
        Gerenciamento de Resultado
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row" id="descricao">
      <label for="lststatus">
         Status
      </label>
     	<select name="lststatus" id="lststatus">
        {html_options values=$opcoesidstatus output=$opcoestatus selected=$opcoestatuspad}
		  </select>
  		<label for="datainicio" class="espaco">
			  Datas de In&iacute;cio (Certame)
		  </label>
		  <input type="text" id="datainicio" name="datainicio" class="data requerido" value="{$datainicio}"/>
		  <input type="text" id="datafim" name="datafim" class="data requerido" value="{$datafim}">
   		<button id="btnconsultar">Consultar</button>
   		<br /><br />
 		<label>Total de registros encontrados = {$total}</label>
		<table cellspacing="0" id="listadados">
			<colgroup>
				<col id="concurso" />
				<col id="editar" />
			</colgroup>
			<thead>
				<tr>
					<th scope="col" width="95%">Concurso</th>
					<th scope="col" width="5%" >Alterar</th>
				</tr>
			</thead>
			<tbody>
				{section name=i loop=$codigo}
				<tr bgcolor="{cycle values=$cor_linha}" class="linha">
					<td>{$descricao[i]}</td>
					<td align="center"><a href="{$links_editar[i]}" class="load">
					<img src="img/editar.png" name="editar" width="16" height="16" border="0" class="tool" align="absmiddle">
					</a></td>
				</tr>
				{/section}
			</tbody>
		</table>
    </div>
</fieldset>
</form>
