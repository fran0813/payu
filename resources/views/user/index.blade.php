@if(auth()->user()->hasRole('User'))

    @extends('layouts.base')

    @include('user.navbar')
    
    @section('content')
    <div class="container">
        <div class="row">            
            <div class="col-md-12 col-ls-12 col-sm-12">

                <h2>Para poder participar de nuestra actividad lúdica te invitamos a generar el pago.</h12>

                <div style="padding-left: 0px; margin-top: 5px; margin-bottom: 5px;" id="respuesta" class="col-md-12 col-ls-12 col-sm-12"></div>

                <div class="col-md-12 col-ls-12 col-sm-12 center-block">

                    <form id="formPago" method="post" action="https://gateway.payulatam.com/ppp-web-gateway/pb.zul" accept-charset="UTF-8">
                      <input class="center-block" type="image" border="0" alt="" src="http://www.payulatam.com/img-secure-2015/boton_pagar_pequeno.png" onClick="this.form.urlOrigen.value = window.location.href;"/>
                      <input name="buttonId" type="hidden" value="/Jx+ywVpNSAWxNXV5IjBPsOfSDyc3wH99fbEB8ZavH3oFOc5XQhJLQ=="/>
                      <input name="merchantId" type="hidden" value="546464"/>
                      <input name="accountId" type="hidden" value="548679"/>
                      <input name="description" type="hidden" value="Actividad lúdica de colaboración mutua"/>
                      <input name="referenceCode" type="hidden" value="Actividad lúdica"/>
                      <input name="amount" type="hidden" value="100.00"/>
                      <input name="tax" type="hidden" value="0.00"/>
                      <input name="taxReturnBase" type="hidden" value="0"/>
                      <input name="currency" type="hidden" value="USD"/>
                      <input name="lng" type="hidden" value="es"/>
                      <input name="approvedResponseUrl" type="hidden" value="http://fundadif.ssl.com.co/user/seleccionarNumeros"/>
                      <input name="displayShippingInformation" type="hidden" value="NO"/>
                      <input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
                      <input name="buttonType" value="SIMPLE" type="hidden"/>
                      <input name="signature" value="fb1fe063ea989425e0b630eb773ee26069d1a4fd4cd32cffdc24bd95ffa055e7" type="hidden"/>
                    </form>

                </div>

            </div>
        </div>
    </div>
    @endsection

    @section('javascript')
        <script src="{{ asset('js/user/pago.js') }}"></script>
    @endsection

@else
    <div class="col-md-12 col-ls-12 col-sm-12 text-center">
        <h1>No tiene permisos para ver esta página</h1>
    </div>
@endif