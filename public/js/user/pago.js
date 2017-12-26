$( document ).ready(function()
{
	verificar();
});

$("#formPago").on("submit", function()
{
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/user/checkUser",
		dataType: 'json',
		data: { }
	})

	.done(function(response){
	
	});
	
});

function verificar() {
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/user/verificarLoteria",
		dataType: 'json',
		data: { }
	})

	.done(function(response){
		if(response.html == true){
			verificarUsuario();
		}else{
			$('#respuesta').html("");
		}	
	});
}

function verificarUsuario() {
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "POST",
		url: "/user/verificarUsuario",
		dataType: 'json',
		data: { }
	})

	.done(function(response){
		if(response.booleanVerificar == true){
			$('#formPago').show();
		}else{
			$('#respuesta').html(response.html);
			$('#formPago').hide();
		}	
	});
}
