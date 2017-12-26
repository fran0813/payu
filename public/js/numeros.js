$( document ).ready(function()
{
	
});

// Crea los numeros
$("#formCrearLoteria").on("submit", function()
{
	var tamaño = $("#numero").val();
	var titulo = $("#titulo").val();
	var descripcion = $("#descripcion").val();

	$("#respuestaCrearNumeros").html("");
	$("#tablaNumerosGenerados").fadeOut(1000);
	$("#loader").html("<label class='control-label'>Cargando</label><div class='center-block loader'></div>")
	$("#loader").fadeIn(1000);

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "GET",
		url: "/admin/generarNumeros",
		dataType: 'json',
		data: { tamaño: tamaño,
				titulo: titulo,
				descripcion: descripcion,}
	})

	.done(function(response){
		$("#loader").fadeOut(1000);
		$('#tablaNumerosGenerados').html(response.html).fadeIn(2000);
		$('#respuestaCrearNumeros').hide();
		$('#respuestaCrearNumeros').html(response.html2).delay(100).fadeIn(2000);
	});
	return false;
});
