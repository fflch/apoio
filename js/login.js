/**
 * @author ricf
 */
$(function(){
	$("#formulario").bind("submit", ValidarForm);
});

function ValidarForm(e)
{
	var canSubmit = true;
	$(".requerido").each(function(){
 	 	$(this).parent().find("em").remove();
		$(this).css("border","1px solid #455296");
        if ($(this).val().length < 1)
		  	{
				canSubmit = false;
				$(this).css("border","1px solid #760000");
				$(this).after("<em>requerido</em>");
            }
    });
	return canSubmit;
}
