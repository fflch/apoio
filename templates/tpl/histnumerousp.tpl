<form id="formulario" action="{$link_consultar}">
<fieldset>
    <legend>
        Hist&oacute;rico da Composi&ccedil;&atilde;o
    </legend>
	<div class="row" id="mensagem">
        <label for="mensagem" class="mensagem">
            {$mensagem}
        </label>
    </div>
    <div class="row" id="descricao">
        <label for="edtpesquisa">
            N&ordm; USP
        </label>
        <input name="edtpesquisa" id="edtpesquisa" type="text" class="requerido"/>
   		<button id="btnconsultar">Consultar</button>
   		<br />
        {if $nome != ''}
        <br />
        <h1>{$nome}</h1>
        <br />
        <label>Titular</label>
		<table cellspacing="0" id="listadados">
			<colgroup>
				<col id="depto" />
				<col id="cargo" />
				<col id="pertence" />
				<col id="inicio" />
                <col id="termino" />
			</colgroup>
			<thead>
				<tr>
					<th scope="col" align="center" width="7%">Depto</th>
					<th scope="col" width="63%">Cargo</th>
					<th scope="col" align="center" width="10%">Pertence</th>
					<th scope="col" align="center" width="10%">Inicio</th>
                    <th scope="col" align="center" width="10%">Termino</th>
				</tr>
			</thead>
			<tbody>
				{section name=i loop=$id_titular}
				<tr bgcolor="{cycle values=$cor_linha}" class="linha">
					<td align="center">{$sigla[i]}</td>
					<td>{$cargo[i]}</td>
                    <td align="center">{$pertence[i]}</td>
					<td align="center">{$inicio[i]}</td>
					<td align="center">{$termino[i]}</td>
				</tr>
				{/section}
			</tbody>
		</table>
        <label for="mensagem" class="mensagem">
            {$total_titular}
        </label>

        <br /><br />
        <label>Suplente</label>
		<table cellspacing="0" id="listadados">
			<colgroup>
				<col id="depto" />
				<col id="cargo" />
				<col id="pertence" />
				<col id="inicio" />
                <col id="termino" />
			</colgroup>
			<thead>
				<tr>
					<th scope="col" align="center" width="7%">Depto</th>
					<th scope="col" width="63%">Suplente do Cargo - Titular</th>
					<th scope="col" align="center" width="10%">Pertence</th>
					<th scope="col" align="center" width="10%">Inicio</th>
                    <th scope="col" align="center" width="10%">Termino</th>
				</tr>
			</thead>
			<tbody>
				{section name=i loop=$id_suplente}
				<tr bgcolor="{cycle values=$cor_linha}" class="linha">
					<td align="center">{$sigla_suplente[i]}</td>
					<td>{$cargo_titular[i]} - {$nome_titular[i]}</td>
                    <td align="center">{$pertence_suplente[i]}</td>
					<td align="center">{$inicio_suplente[i]}</td>
					<td align="center">{$termino_suplente[i]}</td>
				</tr>
				{/section}
			</tbody>
		</table>
        <label for="mensagem" class="mensagem">
            {$total_suplente}
        </label>
        {/if}
    </div>
</fieldset>
</form>
