$( document ).ready(function()
{
	tablaNumeros();
});

$("#tablaNumeros").on("click", "td", function(){

	var id = $(this).attr("id");

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "GET",
		url: "/admin/mostrarInformacionDelPago",
		dataType: 'json',
		data: { id: id }
	})

	.done(function(response) {
		$("#modalInformacionRespuesta").html(response.html);
	});

});	

function tablaNumeros()
{
	$("#tablaNumeros").html("");
	$("#tablaNumeros").fadeOut(1000);
	$("#loader").html("<label class='control-label'>Cargando</label><div class='center-block loader'></div>")
	$("#loader").fadeIn(1000);

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "GET",
		url: "/admin/mostrarTablaDeVerificacion",
		dataType: 'json',
		data: { }
	})

	.done(function(response){
		$("#loader").fadeOut(1000);
		$('#tablaNumeros').hide();
		$('#tablaNumeros').html(response.html).delay(100).fadeIn(3000);
	});
}

// Esc modal
$(document).bind('keydown',function(eEvento){
    if(eEvento.which == 27) { 
        var $jQuery = window.parent.$;
        $jQuery('body').find('#modalInformacion').trigger('click');
    }
});
