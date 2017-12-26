$( document ).ready(function()
{
	tablaLoterias();
});

$("#tablaLoterias").on("click", "a", function(){

	var clase = $(this).attr("class");
	var id = $(this).attr("id");

	if(clase == "btn btn-success"){

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

});

function tablaLoterias()
{
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		method: "GET",
		url: "/admin/mostrartablaLoteria",
		dataType: 'json',
		data: { }
	})

	.done(function(response){
		$('#tablaLoterias').html(response.html).fadeIn(1000);
	});
}

