<form id="formulario" action="{$target}" >
<div id="cedula">
  <div class="descricao">
    <label>{$pauta} - Item {$item}</label>
<!--    <label>  ID-Concurso = {$id_concurso}</label>-->
<!--    <label>  Item = {$item}</label>-->
    <p>{$descricao}</p>
  </div><br/><br/>
<!--  <p class="descricao">{$descricao}</p><br/><br/>-->
  {if $tipo == "I"}
	{section name=i loop=$id_pessoa}
		<table cellspacing="0" id="listadados">
			<colgroup>
				<col id="Nome" />
				<col id="Sim" />
				<col id="Nao" />
			</colgroup>
			<thead>
				<tr>
					<th scope="col" width="70%"></th>
					<th scope="col" Width="15%" align="center"><input type="radio" id="todos_sim" name="todos"><label for="todos_sim" class="hand">Todos Sim</label></th>
					<th scope="col" width="15%" align="center"><input type="radio" id="todos_nao" name="todos"><label for="todos_nao" class="hand">Todos N&atilde;o</label></th>
				</tr>
			</thead>
			<tbody>
				{section name=i loop=$id_pessoa}
				<tr bgcolor="{cycle values=$cor_linha}">
					<td width="70%"><label>{$nome[i]}</label></td>
					<td width="15%" align="center" class="radiosim">
					  <input type="radio" id="rdtiposim{$id_pessoa[i]}" name="rdtipo[{$smarty.section.i.index}]" value="SIM-{$id_pessoa[i]}" class="radio_sim"><label for="rdtiposim{$id_pessoa[i]}" class="hand">Sim</label>
					</td>
					<td width="15%" align="center" class="radionao">
				    <input type="radio" id="rdtiponao{$id_pessoa[i]}" name="rdtipo[{$smarty.section.i.index}]" value="NAO-{$id_pessoa[i]}" class="radio_nao"><label for="rdtiponao{$id_pessoa[i]}" class="hand">N&atilde;o</label>
				  </td>
				</tr>
				{/section}
			</tbody>
		</table>
		<input name="qtde_inscrito" type="hidden" id="qtde_inscrito" value="{$qtde_inscrito}" />
	{/section}
	{elseif $tipo == "B"}
	  <div id="bancafflch" class="banca">
      <fieldset>
        <legend>FFLCH - Escolha {$qtde_fflch} Nome(s)</legend>
       {section name=i loop=$id_pessoa}
         {if $origem[i] == "FFLCH"}
           <p>
			       <input type="checkbox" id="check{$id_pessoa[i]}" name="check[{$smarty.section.i.index}]" value="{$id_pessoa[i]}">
			       <label for="check{$id_pessoa[i]}" class="hand">{$nome[i]} ({$titulo[i]} {$instituicao[i]}) </label>
			     </p>
			   {/if}
       {/section}
       {section name=x loop=$qtde_fflch}
         <p {if $smarty.section.x.index == 0} class="first" {/if}>
           <input type="text" name="nomefflch[{$smarty.section.x.index}]"><span class="apagar">Apagar</span>
         </p>
       {/section}
      </fieldset>
	  </div>
	  <div id="bancaexterna" class="banca">
	     <fieldset>
	       <legend>Externo - Escolha {$qtde_fora} Nome(s)</legend>
	         {section name=i loop=$id_pessoa}
             {if $origem[i] == "EXTERNO"}
              <p>
			         <input type="checkbox" id="check{$id_pessoa[i]}" name="check[{$smarty.section.i.index}]" value="{$id_pessoa[i]}" >
			         <label for="check{$id_pessoa[i]}" class="hand">{$nome[i]} ({$titulo[i]} {$instituicao[i]})</label>
	            </p>
			       {/if}
           {/section}
           {section name=x loop=$qtde_fora}
             <p {if $smarty.section.x.index == 0} class="first" {/if}>
               <input type="text" name="nomefora[{$smarty.section.x.index}]"><span class="apagar">Apagar</span>
             </p>
           {/section}
	     </fieldset>
	  </div>
		<input name="qtde_fflch" type="hidden" id="qtde_fflch" class="bancafflch" value="{$qtde_fflch}" />
		<input name="qtde_fora" type="hidden" id="qtde_fora" class="bancaexterna" value="{$qtde_fora}" />
	  <div class="clear"></div>
  {else}
    <div id="pergunta">
		  <h3 align="center">{$pergunta}</h3><br/>
 		  <div class="resposta">
	  	  <input type="radio" id="rdperguntasim" name="rdpergunta" value="SIM" class="radio"><label for="rdperguntasim" class="hand">Sim</label>
		    <input type="radio" id="rdperguntanao" name="rdpergunta" value="NAO" class="radio"><label for="rdperguntanao" class="hand">N&atilde;o</label>
  	    <input name="id_pergunta" type="hidden" id="id_pergunta" value="{$id_pergunta}" />
		  </div>
		</div>
  {/if}

</div>
<div id="botoes">
  <button id="btnBranco" value="#conteudo" class="voto">Branco</button>
  <button id="btnNulo" value="#conteudo" class="voto">Nulo</button>
  <button id="btnSalvar" value="#conteudo" class="voto">Confirmar</button>
</div>

<input name="id_cedula" type="hidden" id="id_cedula" value="{$id_cedula}" />
<input name="id_concurso" type="hidden" id="id_concurso" value="{$id_concurso}" />
<input name="votacao" type="hidden" id="votacao" value="{$votacao}" />
<input name="tipo" type="hidden" id="tipo" value="{$tipo}" />
</form>
