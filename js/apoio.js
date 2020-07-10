$(document).ready(function(){
  menu();
  atribuir();

  $("#btnsalvar").live("click",function(e){
    e.preventDefault();
    var destino = $(this).val();
    if (requerido()) {
      CanSubmit = true;
      var pagina = $("#formulario").attr("action");
      if (pagina == 'cadconcurso.php?') {
        $("#edtermino").css("border","1px solid #455296").next("em").remove();
        var dtinicio = $("#edtinicio").val();
        var dtfinal  = $("#edtermino").val();
        var CanSubmit = false;
        if (comparar_datas(dtinicio,dtfinal)) {
          CanSubmit = true;
        }
        else {
          $("#edtermino").css("border","1px solid #760000").after("<em>Data de término menor que a data de início!</em>");
        }
        if ($("#edtinicioprova")[0]) {
          $("#edtinicioprova").css("border","1px solid #455296").next("em").remove();
          $("#edterminoprova").css("border","1px solid #455296").next("em").remove();
          var dtinicioprova = $("#edtinicioprova").val();
          var dterminoprova = $("#edterminoprova").val();
          if (dtinicioprova.length < 1 & dterminoprova.length > 1) {
            $("#edtinicioprova").css("border","1px solid #760000").after("<em>requerido</em>");
            CanSubmit = false;
          }
          else if (dtinicioprova.length > 1 & dterminoprova.length < 1) {
            $("#edterminoprova").css("border","1px solid #760000").after("<em>requerido</em>");
            CanSubmit = false;
          }
          else if (dtinicioprova.length > 1 & dterminoprova.length > 1) {
            if (comparar_datas(dtinicioprova,dterminoprova)) {
              CanSubmit = true;
            }
            else {
              $("#edterminoprova").css("border","1px solid #760000").after("<em>Data de término menor que a data de início!</em>");
              CanSubmit = false;
            }
          }
        }
      }
      else if (pagina == 'cadtitular.php?' || pagina == 'cadsuplente.php?') {
        $("#edtermino").css("border","1px solid #455296").next("em").remove();
        var dtinicio = $("#edtinicio").val();
        var dtfinal  = $("#edtermino").val();
        var CanSubmit = false;
        if (comparar_datas(dtinicio,dtfinal)) {
          CanSubmit = true;
        }
        else {
          $("#edtermino").css("border","1px solid #760000").after("<em>Data de término menor que a data de início!</em>");
        }
      }
      if (CanSubmit) {
          var serializeDados = $('#formulario').serialize();
          requisitarAjax(pagina, serializeDados, destino);
      }
	}
  });

  $(".load").live("click",function(e) {
    e.preventDefault();
	var pagina = $(this).attr("href");
	navegar(pagina);
  });

  $(".loadaba").live("click",function(e) {
    e.preventDefault();
	var pagina = $(this).attr("href");
    if (pagina == "#") {
	  return false;
    }
    else {
      var iconCarregando = criaImagem();
      $("#aba").html(iconCarregando).load(pagina, function(responseText, textStatus, XMLHttpRequest) {
	    $(iconCarregando).remove();
	    $(":input:visible:enabled:first").focus();
      });
    }
  });

  $(".excluir").live("click",function(e) {
    e.preventDefault();
 	if (confirm("Confirma a exclusão do registro?")) {
 	  return true;
	} else {
	  return false;
	}
  });

  $("#btnconsultar").live("click",function(e){
    e.preventDefault();
    if (requerido()) {
      if (verifica_lstcampo()) {
        var pagina = $("#formulario").attr("action") + $("#formulario").serialize();
        navegar(pagina);
 	  }
 	}
  });

  $(".data").live("click",function() {
    $(this).datepicker({changeMonth: true, changeYear: true, showOn:'focus'}).focus();
  });

  $(".data").live("keypress",function() {
    return false;(function () {
      $(this).slideUp();
    });
  });

  $('a', $('#aba_nav')).live("click", function(e) {
    e.preventDefault();
    if ($(this).attr("class") == "corrente" || $("#codigo").val() <= 0 ) {
      return false;
    }
    else  {
      var pagina = $(this).attr("href")+"codigo="+$("#codigo").val();
      $(this).parents('#aba_nav').find('a').removeClass('corrente');
      $(this).addClass('corrente');
      var iconCarregando = criaImagem();
      $("#aba").html(iconCarregando).load(pagina, function(responseText, textStatus, XMLHttpRequest) {
        $(iconCarregando).remove();
      });
    }
  });

  $('#edtpessoa').live("focus",function (event) {
     $(this).autocomplete({
        source: "pessoas.php",
        minLength: 1,
        select: function(event, ui) {
          $('#idpessoa').val(ui.item.id);
        }
     });
  });

  $('#edtcomissao').live("focus",function (event) {
     var id = $('#codigo').val();
     $(this).autocomplete({
        source: "comissao.php?idconcurso="+id,
        minLength: 1,
        select: function(event, ui) {
          $('#idpessoa').val(ui.item.id);
        }
     });
  });

  $('#edtitular').live("focus",function (event) {
     var tipo = $('#lstpertence').val();
     $(this).autocomplete({
        source: "comptitular.php?composicao="+tipo,
        minLength: 1,
        select: function(event, ui) {
          $('#idtitular').val(ui.item.id);
          $('#edtcargo').val(ui.item.cargo);
          $('#edtpessoa').focus();
        }
     });
  });

  $("#lstcampoconcurso").live("change", function() {
     if ( $(this).val() == "descricao" ) {
      $("#edtpesquisa").addClass("requerido");
     }
     else {
      $("#edtpesquisa").removeClass("requerido");
     }
  });

  $(".numero").live("keypress", function(e){
    if ((e.which>=48 && e.which<=57) || e.which==8 || e.which==0 || e.which==46) {
     return true;
    } else {
     return false;
    }
  });


  $("#lstdepartamento").live("change", function(){
    if( $(this).val() ) {
      $('#lstarea').html('<option value="">Aguarde... </option>');
      $.getJSON("area.php",{id: $(this).val(), ajax: 'true'}, function(j){
        var options = '<option value="">Selecione a Area</option>';
        for (var i = 0; i < j.length; i++) {
          options += '<option value="' + j[i].optionValue + '">' + j[i].optionValue + '</option>';
        }
        $("#lstarea").html(options);
      })
    }
    else {
      $('#lstarea').html('<option value="">Escolha um Depto.</option>');
    }
  });


  $("#lstipo").live("change", function(){
    if( $(this).val() ) {
      $('#lstconcurso').html('<option value="">Aguarde... </option>');
      $.getJSON("tipoconcurso.php",{tipo: $(this).val(), ajax: 'true'}, function(j){
        var options = '<option value="">Selecione o Edital do Concurso</option>';
        for (var i = 0; i < j.length; i++) {
          options += '<option value="' + j[i].optionId + '">' + j[i].optionValue + '</option>';
        }
        $("#lstconcurso").html(options);
      })
      if ($(this).val() == 'R' || $(this).val() == 'O') {
        if ($(this).val() == 'O') {
          $(".lstconcurso").hide();
          $(".lstconcurso > select").removeClass("requerido");
          $(".cedoutrodescricao").show("fast");
          $(".cedoutrodescricao > input").addClass("requerido maior");          
        }
        else {
          $(".cedoutrodescricao").hide();
          $(".cedoutrodescricao > input").removeClass("requerido");
        } 
        $(".cedoutro").show("fast");
        $(".cedoutro > input").addClass("requerido maior");
      }
      else {
          $(".lstconcurso").show("fast");
          $(".lstconcurso > select").addClass("requerido");
        $(".cedoutrodescricao").hide();
        $(".cedoutrodescricao > input").removeClass("requerido");
        $(".cedoutro").hide();
        $(".cedoutro > input").removeClass("requerido");
      }
    }
    else {
      $(".cedoutro").hide();
      $(".cedoutro > input").removeClass("requerido");
      $('#lstconcurso').html('<option value="">Escolha o Tipo</option>');
    }
  });

  $("#lstdepto").live("change", function() {
     var pagina = $("#formulario").attr("action") + $("#formulario").serialize();
     navegar(pagina);
  })


  $("#lststatuscertame").live("change", function(){
    if ($(this).val() == "F") {
      $(".data").addClass("requerido");
      $("#datacertame").css("display","inline");
    }
    else {
      $(".data").removeClass("requerido").next("em").remove();
      $("#datacertame").css("display","none");
    }
  });

  $("#lstcargo").live("change", function() {
    var texto = $(this).val();
    $("#edtexto").val(texto);
  });

  $("#btnvisualizar").live("click", function(e){
    e.preventDefault();
    if (requerido()) {
     $("#formulario").submit();
    }
  });

  $("#btnrecibo").live("click", function(e){
    e.preventDefault();
    var destino = $(this).val();
    var pagina = $("#frmrecibo").attr("action");
    var serializeDados = $("#frmrecibo").serialize();
    requisitarAjax(pagina, serializeDados, destino);
  });

  //funções janela modal
  $('a[name=modal]').live("click", function(e) {
    e.preventDefault();
	var janela = $(this).attr('href');
    var codigo = $(this).attr('id');

	var maskHeight = $(document).height();
	var maskWidth = $(window).width();
	$('#mask').css({'width':maskWidth,'height':maskHeight});
	$('#mask').fadeIn(1000);
	$('#mask').fadeTo("slow",0.8);
	//Get the window height and width
	var winH = $(window).height();
	var winW = $(window).width();
	$(janela).css('top',  winH/2-$(janela).height()/2);
	$(janela).css('left', winW/2-$(janela).width()/2);
	$(janela).fadeIn(2000).load("cedulamodal.php?"+codigo);
  });

  $('.window .close').live("click", function (e) {
	e.preventDefault();
	$('#mask').hide();
	$('.window').hide();
  });

  $('#mask').live("click", function (e) {
	$(this).hide();
	$('.window').hide();
  });

  $('#todos').live("click", function(e) {
    if ($(this).is(":checked")) {
      $('.check').attr("checked",true);
      $('#lstvotacao').addClass('requerido');
    }
    else {
      $('.check').attr("checked",false);
      $('#lstvotacao').removeClass('requerido');
    }
  });

  $('.check').live("click", function(e) {
    if ($(this).is(":checked")) {;
      if (verificaCheckbox()) {
        $('#todos').attr("checked",true);
        $('#lstvotacao').addClass('requerido');
      }
    }
    else {
      $('#todos').attr("checked",false);
      $('#lstvotacao').removeClass('requerido');
    }
  });

  //fim das funções

});

function menu()
{
	$("ul.submenu").hide();
	$("#menuNav a.menu").click(function(){
      $(this).next("ul.submenu").slideToggle("slow")
	  $("ul.submenu:visible").not($(this).next("ul.submenu")).slideUp("slow");
      $(this).toggleClass("corrente");
      $("#menuNav a.menu").not($(this)).removeClass("corrente");
	  return false;
	});
}

function atribuir()
{
  $("#menuNav a").click(function(){
    navegar($(this).attr("href"));
    return false
  })
}

function navegar(pagina)
{
  if (pagina == "#") {
	return false;
  }
  else {
    var iconCarregando = criaImagem();
    $("#conteudo").html(iconCarregando).load(pagina, function(responseText, textStatus, XMLHttpRequest) {
	  $(iconCarregando).remove();
	  $(":input:visible:enabled:first").focus();
    });
  }
}

function requerido(){
  var CanSubmit = true;
  $(".requerido").each(function(){
	$(this).css("border","1px solid #455296").next("em").remove();
    $(this).val($.trim($(this).val()));
	  if ($(this).val().length < 1)	{
		$(this).css("border","1px solid #760000").after("<em>requerido</em>");
		CanSubmit = false;
      }
    });
  return CanSubmit;
}

function verifica_lstcampo(){
  var CanSubmit = true;
  if ($("#lstcampo").val() == "id") {
	if ( !isInteger($("#edtpesquisa").val()) ) {
      $(".requerido").each(function(){
		$(this).css("border", "1px solid #760000").after("<em>Digite um n&uacute;mero</em>");
      });
      CanSubmit = false;
     }
   }
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
  return $('<img src="img/carregando.gif" class="icon" alt="carregando..."/>');
}

function isInteger(sNum){
   // EXPRESSAO REGULAR PARA ACEITAR APENAS NUMEROS INTEIROS
   var reDigits = /^\d+$/;
   return reDigits.test(sNum);
}

function comparar_datas(dtinicio,dtfinal) {
  var datainicial = parseInt(dtinicio.split("/")[2].toString() + dtinicio.split("/")[1].toString() + dtinicio.split("/")[0].toString());
  var datafinal = parseInt(dtfinal.split("/")[2].toString() + dtfinal.split("/")[1].toString() + dtfinal.split("/")[0].toString());
  if (datainicial > datafinal) {
    return false;
  }
  else {
    return true;
  }
}

function verificaCheckbox() {
  var todoschecados = true;
  $('.check').each(function() {
    if ($(this).is(":checked")) {
    }
    else {
      todoschecados = false;
    }
   });
  return todoschecados;
}
