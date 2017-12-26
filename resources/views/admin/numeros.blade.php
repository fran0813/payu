@if(auth()->user()->hasRole('Admin'))

	@extends('layouts.base')

    @include('admin.navbar')

    @section('content')
    <div class="container">
        <div class="row">        

            {{-- @include('layouts.status') --}}

			<form id="formCrearLoteria">
	            <div class="col-md-6 col-ls-6 col-sm-6" style="margin-bottom: 20px;">
					
					<div class="col-md-12 col-ls-12 col-sm-12">
						<label class="control-label" for="titulo">Título</label>
						<input class="form-control" type="text" id="titulo" required>
					</div>

					<div style="margin-top: 5px; margin-bottom: 5px;" class="col-md-12 col-ls-12 col-sm-12"></div>

					<div class="col-md-12 col-ls-12 col-sm-12">
						<label class="control-label" for="descripcion">Descripción</label>
						<textarea class="form-control" id="descripcion" rows="4" style="resize: none;"></textarea>
					</div>
	            </div>

	            <div class="col-md-6 col-ls-6 col-sm-6" style="margin-bottom: 20px;">
		
					<div class="col-md-12 col-ls-12 col-sm-12">
						<label class="control-label" for="numero">Cuantos números quiere generar?</label>
						<input class="form-control" type="number" id="numero" min="10" value="10000" style="margin-bottom: 10px;" required>
						<button id="generar" class="btn btn-info" type="submit">Crear</button>

						<div style="margin-top: 5px; margin-bottom: 5px;" class="col-md-12 col-ls-12 col-sm-12"></div>

						<div id="respuestaCrearNumeros"></div>							
					</div>
					      
	            </div>
	        </form>

	        <div style="margin-top: 5px; margin-bottom: 5px;" class="col-md-12 col-ls-12 col-sm-12"></div>
			
			<div class="col-md-12 col-ls-12 col-sm-12 text-center" id="loader"></div>

			<div style="margin-top: 5px; margin-bottom: 5px;" class="col-md-12 col-ls-12 col-sm-12"></div>

			<div class="col-md-12 col-ls-12 col-sm-12" id="tablaNumerosGenerados"></div>			

        </div>
    </div>
    @endsection

@section('javascript')
	<script src="{{ asset('js/admin/numeros.js') }}"></script>
@endsection

@else
    <div class="col-md-12 col-ls-12 col-sm-12 text-center">
        <h1>No tiene permisos para ver esta página</h1>
    </div>
@endif