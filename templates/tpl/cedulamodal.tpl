<div id="cedula">
  <a href="#" class="close">Fechar [X]</a>
  <div class="descricao">
    <p>{$pauta} - Item {$item}<br />
       {$descricao}
    </p>
  </div>
  {if $tipo == "I"}
	{section name=i loop=$id_pessoa}
		<table cellspacing="0">
			<colgroup>
				<col id="Nome" />
				<col id="Sim" />
				<col id="Nao" />
			</colgroup>
			<thead>
				<tr>
					<th scope="col" width="70%"></th>
					<th scope="col" Width="15%" align="center"><input type="radio" class="radio">Todos Sim</th>
					<th scope="col" width="15%" align="center"><input type="radio" class="radio">Todos N&atilde;o</th>
				</tr>
			</thead>
			<tbody>
				{section name=i loop=$id_pessoa}
				<tr bgcolor="{cycle values=$cor_linha}">
					<td width="70%">{$nome[i]}</td>
					<td width="15%" align="center">
					  <input type="radio" class="radio">Sim
					</td>
					<td width="15%" align="center">
				    <input type="radio" class="radio">N&atilde;o
				  </td>
				</tr>
				{/section}
			</tbody>
		</table>
	{/section}
	{elseif $tipo == "B"}
	  <div id="bancafflch" class="banca">
      <fieldset>
        <legend>FFLCH - Escolha {$qtde_fflch} Nome(s)</legend>
       {section name=i loop=$id_pessoa}
         {if $origem[i] == "FFLCH"}
           <p>
			       <input type="checkbox" class="checkbox">{$nome[i]} ({$titulo[i]} {$instituicao[i]})
			     </p>
			   {/if}
       {/section}</br >
       {section name=x loop=$qtde_fflch}
         <p>
           <input type="text"><span>Apagar</span>
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
			         <input type="checkbox" class="checkbox">{$nome[i]} ({$titulo[i]} {$instituicao[i]})
	            </p>
			       {/if}
           {/section}</br >
           {section name=x loop=$qtde_fora}
             <p>
               <input type="text"><span>Apagar</span>
             </p>
           {/section}
	     </fieldset>
	  </div>
	  <div class="clear"></div>
  {else}
    <div id="pergunta">
		  <h2 align="center">{$pergunta}</h2><br/>
 		  <div class="resposta">
	  	  <input type="radio" id="rdperguntasim" name="rdpergunta" class="radio"><label>Sim</label>
		    <input type="radio" id="rdperguntanao" name="rdpergunta" class="radio"><label>N&atilde;o</label>
		  </div>
		</div>
  {/if}
</div>
