$( document ).ready(function()
{
	loteriaActual();
	tablaLoteria();
});

$("#tablaSeleccionarLoteria").on("click", "a", function(){

	var clase = $(this).attr("class");
	var id = $(this).attr("id");
	idLoteria(id);

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "GET",
		url: "/admin/mostrarTituloDeLoteria",
		dataType: 'json',
		data: { id: id }
	})

	.done(function(response){
		$('#modalConfirmarLoteriaTitulo').html(response.html);
	});

});

$("#confirmarSeleccion").on("submit", function()
{
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "GET",
		url: "/admin/seleccionarLoteria",
		dataType: 'json',
		data: { }
	})

	.done(function(response) {
		loteriaActual();
		$('#respuestaSeleccionar').html(response.html);
	});
	return false;
});

function tablaLoteria()
{
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "GET",
		url: "/admin/mostrarTablaSeleccionarLoteria",
		dataType: 'json',
		data: { }
	})

	.done(function(response){
		$('#tablaSeleccionarLoteria').html(response.html).fadeIn(1000);
	});
}

function loteriaActual()
{
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "GET",
		url: "/admin/mostrarLoteriaActiva",
		dataType: 'json',
		data: { }
	})

	.done(function(response){
		$('#loteriaActual').html(response.html);
	});
}


function idLoteria(id)
{
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/admin/idLoteria",
		dataType: 'json',
		data: { id: id }
	})

	.done(function(response) {

	});
}

// Esc modal
$(document).bind('keydown',function(eEvento){
    if(eEvento.which == 27) { 
        var $jQuery = window.parent.$;
        $jQuery('body').find('#modalConfirmarLoteria').trigger('click');
    }
});

