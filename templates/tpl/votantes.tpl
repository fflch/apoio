<form id="formulario" action="{$link_consultar}">
<fieldset>
    <legend>
        Relat&oacute;rio de Votantes
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row" id="descricao">
        <label for="lstpertence">
            Pertence
        </label>
   		<select name="lstpertence" id="lstpertence">
  	      {html_options values=$opcoesidpertence output=$opcoespertence selected=$opcoespertencepad}
      </select>
      <input name="edtdata" id="edtdata" type="text" class="data requerido" value="{$data}"/>
   		<button id="btnconsultar">Consultar</button>
   		<br /><br />
		<table cellspacing="0" id="listadados">
			<colgroup>
				<col id="nome" />
			</colgroup>
			<thead>
				<tr>
					<th scope="col">Nome</th>
				</tr>
			</thead>
			<tbody>
				{section name=i loop=$nome}
				<tr bgcolor="{cycle values=$cor_linha}" class="linha">
					<td width="100%">{$nome[i]}</td>
				</tr>
				{/section}
			</tbody>
		</table>
    </div>
</fieldset>
</form>
