<div class="row" id="mensagem">
  <label for="mensagem" class="mensagem">
    {$mensagem}
  </label>
</div>
<form id="formulario" action="cadcomissao.php?">
   <div class="row" id="titularidade">
      <label for="edtcomissao" class="esquerda">
         Nome
      </label>
      <input name="edtcomissao" id="edtcomissao" type="text" class="requerido maior"/>
   </div>
   <div class="row">
      <label for="lstorigem" class="esquerda">
         Origem
      </label>
      <select name="lstorigem" id="lstorigem" class="requerido">
	     <option value="FFLCH">FFLCH</option>
	     <option value="EXTERNO">EXTERNO</option>
 	  </select>
   </div>
   <div class="tools">
      <button id="btnsalvar" value="#aba">Salvar</button>
      <button type="reset">Limpar</button>
      <input name="operacao" type="hidden" id="operacao" value="{$operacao}" />
      <input name="codigo" type="hidden" id="codigo" value="{$codigo}" />
      <input name="idpessoa" type="hidden" id="idpessoa">
      <input name="salvar" type="hidden" id="salvar" value="salvar" />
   </div>
   <br /><br />
   <table cellspacing="0" id="listadados">
	  <colgroup>
		<col id="Nome" />
		<col id="Titulo" />
		<col id="Origem" />
		<col id="excluir" />
	  </colgroup>
	  <thead>
		<tr>
		  <th width="80%" scope="col">Nome</th>
		  <th width="10%" scope="col">Titula&ccedil;&atilde;o</th>
		  <th width="5%" scope="col">Origem</th>
 		  <th width="5%"scope="col">Excluir</th>
	 	</tr>
	  </thead>
		<tbody>
		  {section name=i loop=$nome}
	    <tr bgcolor="{cycle values=$cor_linha}" class="linha">
		    <td width="80%">{$nome[i]}</td>
		    <td width="10%">{$titulo[i]}</td>
		    <td width="5%">{$origem[i]}</td>
		    <td width="5%" align="center"><a href="{$links_excluir[i]}" class="loadaba">
		      <img src="img/excluir.png" name="excluir" width="16" height="16" border="0" class="excluir" align="absmiddle">
		      </a></td>
		  </tr>
		  {/section}
		</tbody>
	</table>
</form>
