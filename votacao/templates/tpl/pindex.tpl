<p id="vot_mensagem">{$vot_mensagem}</p>
<form id="formVotacao" name="formVotacao" class="form">
  <div class="caixa">
     <div class="row" id="mensagem">
       <label for="mensagem" class="mensagem">{$mensagem}</label>
     </div>
     <div  class="row">
       <input type="radio" id="rdtitular" name="rdtipo" value="T" checked><label for="rdtitular" class="hand">Titular</label>
       <input type="radio" id="rdsuplente" name="rdtipo" value="S"><label for="rdsuplente" class="hand">Suplente</label>
     </div>
     <div class="row">
       <label for="edtnusp" class="esquerda">
         N USP
       </label>
       <input name="edtnusp" id="edtnusp" type="text" class="requerido" maxlength="10" size="10" value=""/>
     </div>
     <div class="row selecione" id="cargo">
       <label for="lstcargo" class="esquerda">
         Condi&ccedil;&atilde;o
       </label>
       <select name="lstcargo" id="lstcargo" class="requerido">
         {html_options values=$opcoesidcargo output=$opcoescargo}
       </select>
     </div>
     <div class="row" id="titular">
       <label for="lstitular" class="esquerda">
         Titular
       </label>
       <select name="lstitular" id="lstitular">
             {html_options options=$opcoestitular}
       </select>
     </div>
     <div class="row">
       <label class="esquerda">&nbsp</label><button id="votar" value="#conteudo">Votar</button>
       <input type="hidden" id="pertence" name="pertence" value="{$pertence}">
     </div>
   </div>
</form>
