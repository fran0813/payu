@if(auth()->user()->hasRole('User'))

    @extends('layouts.base')

    @include('user.navbar')

    @section('content')
    <div id="mostrar" style="display: none;" class="container">
        <div class="row">            
            <div class="col-md-12 col-ls-12 col-sm-12">

                <div style="margin-top: 5px; margin-bottom: 5px;" class="col-md-12 col-ls-12 col-sm-12"></div>
            
                <div class="col-md-12 col-ls-12 col-sm-12 text-center" id="loader"></div>

                <div id="respuestaCorreo" class="col-md-12 col-ls-12 col-sm-12"></div>   

                <form id="formNumeros">
                    <div class="col-md-4 col-ls-4 col-sm-4">
                        <label class="control-label" for="numero">Seleccione los 2 números</label>
                        <p style="color: #000000"><b>Los números deben estar entre 00001 y 10000</b></p>
                        <input id="numero" class="form-control" type="number" min="00001">
                    </div>

                    <div style="margin-top: 5px; margin-bottom: 5px;" class="col-md-12 col-ls-12 col-sm-12"></div>

                    <div class="col-md-4 col-ls-4 col-sm-4">
                        <button class="btn btn-success" type="submit">Enviar</button>
                    </div>
                </form>

                <div id="respuestaNumero" class="col-md-12 col-ls-12 col-sm-12"></div>

            </div>
        </div>
    </div>
    @endsection

    @section('javascript')
        <script src="{{ asset('js/user/numero.js') }}"></script>
    @endsection

@else
    <div class="col-md-12 col-ls-12 col-sm-12 text-center">
        <h1>No tiene permisos para ver esta página</h1>
    </div>
@endif