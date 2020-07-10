<form id="formulario" action="{$link_consultar}">
<fieldset>
    <legend>
        Gerenciamento de C&eacute;dulas
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row" id="descricao">
        <label for="lstcampo">
            Data
        </label>
        <input name="edtpesquisa" id="edtpesquisa" type="text" class="requerido data"/>
   		<button id="btnconsultar">Consultar</button>
   		<br /><br />
		<table cellspacing="0" id="listadados">
			<colgroup>
        <col id="pertence">
				<col id="data">
  			<col id="item"/>
				<col id="pauta">
				<col id="visualizar"/>
				<col id="editar"/>
				<col id="excluir"/>
			</colgroup>
			<thead>
				<tr>
				  <th scope="col" width="10%">Pertence</th>
					<th scope="col" width="10%">Data</th>
					<th scope="col" width="5%">Item</th>
					<th scope="col" width="60%">Pauta</th>
					<th scope="col" width="5%">Visualizar</th>
					<th scope="col" Width="5%">Alterar</th>
					<th scope="col" width="5%">Excluir</th>
				</tr>
			</thead>
			<tbody>
				{section name=i loop=$codigo}
				<tr bgcolor="{cycle values=$cor_linha}" class="linha">
          <td width="10%">{$pertence[i]}</td>
					<td width="10%">{$data[i]}</td>
					<td width="5%">{$item[i]}</td>
					<td width="60%">{$pauta[i]}</td>
					<td width="5%" align="center"><a href="#dialog" id="{$links_visualizar[i]}" name="modal">
					<img src="img/visualizar.png" name="excluir" width="16" height="16" border="0" class="#" align="absmiddle">
					</a></td>
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
<div id="boxes">
  <div id="dialog" class="window">
<!--    <a href="#" class="close">Fechar [X]</a><br />-->
<!--      Janela Modal Simples<br />-->
<!--      Aqui vai o conteúdo da sua Janela Modal Simples.-->
  </div>
  <div id="mask"></div>
</div>
