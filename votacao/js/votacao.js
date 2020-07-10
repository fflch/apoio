$(document).ready(function(){

  $("input:radio").click(function() {
      var tipo = $(this).val();
      if (tipo == 'T') {
        $("#lstitular").removeClass("requerido").css("border","2px solid #455296").next("em").remove();
        $("#titular").hide();
        $("#lstcargo").addClass("requerido");
        $("#cargo").show("slow");
      }
      else if (tipo == 'S') {
        $("#lstcargo").removeClass("requerido").css("border","2px solid #455296").next("em").remove();
        $("#cargo").hide();
        $("#lstitular").addClass("requerido");
        $("#titular").show("slow");

      }
      $("#edtnusp").focus();
  });

  $("#formVotacao").submit(function() {
    if(requerido()) {
       var destino = $(".mensagem");
       var pagina = 'consmembro.php';
       var serializeDados = $(this).serialize();
       var iconCarregando = criaImagem();
       $.ajax({
     	 url: pagina,
	     dataType: 'html',
    	 type: 'POST',
    	 data: serializeDados,
	     beforeSend: function(){
	       $(destino).html(iconCarregando);
    	 },
	     complete: function() {
	       $(iconCarregando).remove();
	     },
	     success: function(data, textStatus) {
	       if (!data) {
	         requisitarAjax('votacao.php', serializeDados, '#conteudo');
	       }
	       else {
	         $(destino).html(data);
	       }
	     },
     	 error: function(xhr,er) {
	       $(destino).html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')
    	 }
       });
     }
    return false;
  });

   $(".voto").live("click", function() {
     var pagina = $("#formulario").attr("action");
     var serializeDados = $('#formulario').serialize();
     var destino = $(this).val();
     var btn = $(this).attr("id");
     if (btn == "btnSalvar"){
       var tipo = $("#tipo").val();
       if (tipo == "I") {
         var total_checado = $("input:checked").length;
         var total_inscrito = $("#qtde_inscrito").val();
         if ( total_checado >= total_inscrito ) {
           requisitarAjax(pagina, serializeDados, destino);
         }
         else {
           alert("Não foi selecionado o total de inscritos!");
         }
       }
       else if (tipo == "B") {
         var total = parseInt($("#qtde_fflch").val()) + parseInt($("#qtde_fora").val());
         var total_checado = $("p input:checked").length;
         $("p input[type=text]").each(function() {
           $(this).val($.trim($(this).val()));
           if ( $(this).val().length > 0 ) {
             total_checado = total_checado + 1;
           }
         });

         if ( total === total_checado ) {
           requisitarAjax(pagina, serializeDados, destino);
         }
         else {
           alert("Você não selecionou toda a banca!");
         }
       }
       else if (tipo == "R") {
         var total_checado = $("input:checked").length;
         if ( total_checado > 0 ){
           requisitarAjax(pagina, serializeDados, destino);
         }
         else {
           alert("Marque Sim ou Não para a pergunta!");
         }
       }
       else if (tipo == "O") {
         var total_checado = $("input:checked").length;
         if ( total_checado > 0 ){
           requisitarAjax(pagina, serializeDados, destino);
         }
         else {
           alert("Marque Sim ou Não para a pergunta!");
         }
       }
     }
     else if (btn == "btnBranco") {
       serializeDados = serializeDados+"&branco=yes";
       requisitarAjax(pagina, serializeDados, destino);
     }
     else if (btn == "btnNulo") {
       serializeDados = serializeDados+"&nulo=yes";
       requisitarAjax(pagina, serializeDados, destino);
     }
     return false;
   });

   $("#todos_sim").live("click", function() {
     var todosRadioSim = $(".radiosim").find(":radio");
     $(todosRadioSim).attr("checked", "checked");
   });

   $("#todos_nao").live("click", function() {
     var todosRadioNao = $(".radionao").find(":radio");
     $(todosRadioNao).attr("checked", "checked");
   });

   $(".radio_sim").live("click", function() {
     var todosNao = $("#todos_nao");
     if(  todosNao.is(":checked") ) {
       todosNao.removeAttr('checked');
     }
   });

   $(".radio_nao").live("click", function() {
     var todosSim = $("#todos_sim");
     if(  todosSim.is(":checked") ) {
       todosSim.removeAttr('checked');
     }
   });

   $(".apagar").live("click", function() {
     $anterior = $(this).prev();
     $anterior.val("");
   });

   $("p input").live("click", function() {
     var elemento = $(this).parents("div").attr("id");
     var total_checado = $("#"+elemento+" input:checked").length;
     var total = $("."+elemento).val();
     $("#"+elemento+" input[type=text]").each(function() {
       $(this).val($.trim($(this).val()));
       if ( $(this).val().length > 0 ) {
         total_checado = total_checado + 1;
       }
     })
     if ( $(this).is(":text") ) {
       if ( total_checado >= total ) {
         alert("Você já selecionou o máximo possível!");
         $(this).blur();
       };
     }
     else if ( $(this).is(":checkbox") ) {
       if ( total_checado > total ) {
         alert("Você já selecionou o máximo possível!");
         $(this).removeAttr('checked');
       };
     }
   });

});

function requerido(){
  var CanSubmit = true;
  $(".requerido").each(function(){
	$(this).css("border","2px solid #455296").next("em").remove();
    $(this).val($.trim($(this).val()));
	  if ($(this).val().length < 1)	{
		$(this).css("border","2px solid #760000").after("<em>requerido</em>");
		CanSubmit = false;
      }
    });
  return CanSubmit;
}

function requisitarAjax(pagina, serializeDados, destino) {
  var iconCarregando = criaImagem();
  $.ajax({
	url: pagina,
	dataType: 'html',
	type: 'POST',
	data: serializeDados,
	beforeSend: function(){
	  $(destino).html(iconCarregando);
	},
	complete: function() {
	  $(iconCarregando).remove();
	},
	success: function(data, textStatus) {
	  $(destino).html(data);
	},
  	error: function(xhr,er) {
	  $(destino).html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')
	}
  });
}

function criaImagem(){
  return $('<img src="../img/carregando.gif" class="icon" alt="carregando..."/>');
}
