@section('navbar')
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
        Loteria <span class="caret"></span>
    </a>

    <ul class="dropdown-menu">
        <li class="text-left">
            <a href="{{ url('/admin/numeros') }}">Generar numeros</a>
            <a href="{{ url('/admin/loteriaSeleccionar') }}">Seleccionar la loteria</a>
        </li>
    </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
        Control <span class="caret"></span>
    </a>

    <ul class="dropdown-menu">
        <li class="text-left">
            <a href="{{ url('/admin/controlLoteria') }}">Verificar loterias</a>
        </li>
    </ul>
</li>
@endsection