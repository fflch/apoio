<form id="formulario" action="habilitar.php?">
<fieldset>
    <legend>
        Gerenciamento de Vota&ccedil;&atilde;o
    </legend>
    {if ($operacao=="consultar")}
    <div class="row">
        <label for="edtpesquisa" class="esquerda">
            Data
        </label>
        <input name="edtpesquisa" id="edtpesquisa" type="text" class="data requerido" value="{$datapesquisa}"/>
        <button id="btnconsultar">Consultar</button>
    </div>
    {elseif ($operacao=="editar")}
    <div class="row">
        <label for="lststatus" class="esquerda">
            Status
        </label>
        <select name="lstvotacao" id="lstvotacao" class="requerido">
          {html_options values=$opcoesidvotacao output=$opcoesvotacao selected=$opcoesvotacaopad}
 	      </select>
    		<button id="btnsalvar" value="#conteudo">Salvar</button>
    		<input name="salvar" type="hidden" id="salvar" value="salvar" />
        <input name="datapesquisada" id="datapesquisada" type="hidden" value="{$datapesquisa}">
    </div>
    {/if}
    <input name="operacao" type="hidden" id="operacao" value="{$operacao}" />
    </br>
  	<div class="row" id="mensagem">
       <label for="mensagem" class="mensagem">
         {$mensagem}
       </label>
    </div>
		<table cellspacing="0" id="listadados">
			<colgroup>
         <col id="tudo">
         <col id="pertence">
         <col id="data">
			   <col id="item">
			   <col id="pauta">
			   <col id="status"/>
			</colgroup>
			<thead>
			  <tr>
			    <th scope="col" width="10%" align="center"><input type="checkbox" id="todos" name="todos"></th>
    	    <th scope="col" width="10%" align="center">Pertence</th>
			    <th scope="col" width="10%" align="center">Data</th>
			    <th scope="col" width="5%" align="center">Item</th>
			    <th scope="col" width="55%">Pauta</th>
			    <th scope="col" width="10%" align="center">Status</th>
			  </tr>
			</thead>
			<tbody>
			{section name=i loop=$codigo}
			  <tr bgcolor="{cycle values=$cor_linha}" class="linha">
        <td width="10%" align="center"><input type="checkbox" id="check{$codigo[i]}" name="check[{$smarty.section.i.index}]" value="{$codigo[i]}" class="check"></td>
			  <td width="10%"align="center">{$pertence[i]}</td>
			  <td width="10%"align="center">{$data[i]}</td>
			  <td width="5%" align="center">{$item[i]}</td>
			  <td width="65%">{$pauta[i]}</td>
			  <td width="10%" align="center">{$votacao[i]}</td>
			  </tr>
			{/section}
			</tbody>
		</table>
</fieldset>
</form>
