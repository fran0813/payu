$( document ).ready(function()
{
	$("#mostrar").show();	
	verificarPago();
});

$("#formNumeros").on("submit", function()
{
	var numero = $("#numero").val();
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/user/verificarNumeros",
		dataType: 'json',
		data: { numero: numero}
	})

	.done(function(response){
		$('#respuestaNumero').html(response.html);
		if(response.booleanMax2 == false){
			$("#formNumeros").hide();
			$("#respuestaNumero").hide();
			correo(response.tempNumero, response.tempNumero2);
		}
	});	
	return false;
});

function verificarPago()
{
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/user/verificarPago",
		dataType: 'json',
		data: { }
	})

	.done(function(response){
		if(response.booleanVerificar == false){
			document.location ="/falso";
		}else{
			$("#mostrar").show();
		}
	});
}

function correo(tempNumero,tempNumero2){

	$("#respuestaCrearNumeros").html("");
	$("#tablaNumerosGenerados").fadeOut(1000);
	$("#loader").html("<label class='control-label'>Cargando</label><div class='center-block loader'></div>")
	$("#loader").fadeIn(1000);

	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/user/correo",
		dataType: 'json',
		data: { tempNumero: tempNumero,
				tempNumero2: tempNumero2, }
	})

	.done(function(response){
		$("#loader").fadeOut(1000);
		$('#respuestaCorreo').hide();
		$("#respuestaCorreo").html(response.html).delay(100).fadeIn(2000);
	});
}