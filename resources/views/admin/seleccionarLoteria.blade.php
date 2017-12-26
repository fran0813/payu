@if(auth()->user()->hasRole('Admin'))

	@extends('layouts.base')

    @include('admin.navbar')

    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-ls-12 col-sm-12" id="loteriaActual"></div>
            <div style="margin-top: 5px; margin-bottom: 5px;" class="col-md-12 col-ls-12 col-sm-12"></div>
            <div class="col-md-12 col-ls-12 col-sm-12" id="tablaSeleccionarLoteria"></div>
        </div>
    </div>
    @endsection

    @include('admin.modal.modalConfirmarSeleccionarLoteria')

@section('javascript')
	<script src="{{ asset('js/admin/seleccionarLoteria.js') }}"></script>
@endsection

@else
    <div class="col-md-12 col-ls-12 col-sm-12 text-center">
        <h1>No tiene permisos para ver esta página</h1>
    </div>
@endif