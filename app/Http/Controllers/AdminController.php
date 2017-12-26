<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use \Response;
use App\Loteria;
use App\Numero;
use App\Pago;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
    	return view('admin.index');
    }

    public function numeros()
    {
    	return view('admin.numeros');
    }

    public function controlLoteria()
    {
    	return view('admin.controlLoteria');
    }

    public function loteria()
    {
    	return view('admin.loteria');
    }

    public function loteriaSeleccionar()
    {
        return view('admin.seleccionarLoteria');
    }

    // Establece el id de la loteria
    public function idLoteria(Request $request)
    {
        $id = $_POST['id'];
        $request->session()->put("idLoteria",$id);
        return Response::json(array('html' => "ok"));
    }

    public function generarNumeros(Request $request)
    {	
    	$html = "";
    	$columnas = 10;
    	$cont = 0;
		$tamaño = $_GET['tamaño'];
		$datos = array();
		$numerosArray = array();
		$html2 = "";
    	$boleanLoteria = False;
    	$titulo = $_GET['titulo'];
    	$descripcion = $_GET['descripcion'];

    	$loterias = Loteria::where('titulo', $titulo)
    						->get();

    	foreach ($loterias as $loteria) {
    		$boleanLoteria = True;
    	}

    	if($boleanLoteria == False){

    		$loteria = new Loteria;
    		$loteria->titulo = $titulo;
    		$loteria->descripcion = $descripcion;
    		$loteria->user_id = Auth::user()->id;
    		$loteria->save();

    		$loterias = Loteria::orderBy('id', 'desc')
                                ->limit(1)
                                ->get();

            foreach ($loterias as $loteria) {
            	$idLoteria = $loteria->id;
            }

			for ($i=0; $i < $tamaño; $i++) {
				$formato = str_pad($i+1, 5, "0", STR_PAD_LEFT);
				array_push($numerosArray, $formato);
				$datos[]= array('numero' => $formato, 'loteria_id' => $idLoteria,);
			}

			$html .= "<table class='table table-bordered'>
	                <thead class='thead-s'>
	                <tr>";

	        for ($i = 0; $i < $columnas; $i++) {
	        	$n = $i+1;
	        	$html .= "<th class='text-center'>Columna $n</th>";
	        }
	       
	        $html .= "</tr>
	                </thead>
	                <tbody>";

	        $html .="<tr class='border-dotted'>";

	        foreach ($numerosArray as $numeroArray) {
	        	$cont++;

	        	$html .= "<td class='text-center'>$numeroArray</td>";

	            if($cont == $columnas){
	            	$cont = 0;
	            	$html .= "</tr>";
	            	$html .= "<tr class='border-dotted'>";
	            }           
	        };

	        $html .= "</tr>";

	        $html .= "</tbody>
	                </table>";

        	Numero::insert($datos);

            $html2 = "Se han generado los numeros con éxito";
    	}else{
    		$html2 = "Ya existe ese título";
    	}

		return Response::json(array('html' => $html, 'html2' => '<h3>'.$html2.'</h3>',));
    }

    public function mostrartablaLoteria()
    {
    	$html = "";
    	$cont = 0;
        $booleanConfirmar = False;
    	$loterias = Loteria::all();

    	$html .= "<table class='table table-bordered'>
                <thead class='thead-s'>
                <tr>";

        $html .= "<th class='text-center'>N°</th>";
        $html .= "<th class='text-center'>Titulo</th>";
        $html .= "<th class='text-center'>Descripción</th>";
        $html .= "<th class='text-center'>Función</th>";

        $html .= "</tr>
                </thead>
                <tbody>";

    	foreach ($loterias as $loteria) {
            $booleanConfirmar = True;
    		$cont++;
    		$id = $loteria->id;
    		$titulo = $loteria->titulo;
    		$descripcion = $loteria->descripcion;

    		$html .= "<tr class='border-dotted'>";
    		$html .= "<td class='text-center'>$cont</td>";
    		$html .= "<td class='text-center'>$titulo</td>";
    		$html .= "<td class='text-center'>$descripcion</td>";
    		$html .= "<td class='text-center'><a id='$id' href='/admin/loteria' class='btn btn-success'>Mirar</a>";
    		$html .= "</tr>";
    	}

    	$html .= "</tbody>
                </table>";

        if($booleanConfirmar == False){
            $html = "<h1 class='text-center'>No hay loterias que mostrar</h1>";
        }

        return Response::json(array('html' => $html,));
    }

    public function mostrarTablaDeVerificacion(Request $request)
    {	
    	$html = "";
    	$columnas = 10;
    	$cont = 0;
    	$idLoteria = null;

        if($request->session()->get("idLoteria")){
            $idLoteria = $request->session()->get("idLoteria");
        }

        if($idLoteria != null){
        	$numeros = Numero::where('loteria_id', $idLoteria)
        					->get();	        

	        $html .= "<table class='table table-bordered'>
	                <thead class='thead-s'>
	                <tr>";

	        for ($i = 0; $i < $columnas; $i++) {
	        	$n = $i+1;
	        	$html .= "<th class='text-center'>Columna $n</th>";
	        }
	       
	        $html .= "</tr>
	                </thead>
	                <tbody>";

	        foreach ($numeros as $numero) {
    			$cont++;
    			$id = $numero->id;
    			$pago = $numero->pago;
    			$numero = $numero->numero;

    			if($pago == "Verdadero"){
    				$html .= "<td id='$id' data-toggle='modal' data-target='#modalInformacion' style='background-color: #2A9C37; color: #FFFFFF;' class='text-center'>$numero</td>";
    			}else{
    				$html .= "<td id='$id' data-toggle='modal' data-target='#modalInformacion' class='text-center'>$numero</td>";
    			}

	            if($cont == $columnas){
	            	$cont = 0;
	            	$html .= "</tr>";
	            	$html .= "<tr class='border-dotted'>";
	            } 			
        	}

        	$html .= "</tr>";

	        $html .= "</tbody>
	                </table>";

    	}
		
		return Response::json(array('html' => $html,));
    }

    public function mostrarTablaSeleccionarLoteria()
    {
        $html = "";
        $cont = 0;
        $loterias = Loteria::all();

        $html .= "<table class='table table-bordered'>
                <thead class='thead-s'>
                <tr>";

        $html .= "<th class='text-center'>N°</th>";
        $html .= "<th class='text-center'>Titulo</th>";
        $html .= "<th class='text-center'>Descripción</th>";
        $html .= "<th class='text-center'>Función</th>";

        $html .= "</tr>
                </thead>
                <tbody>";

        foreach ($loterias as $loteria) {
            $cont++;
            $id = $loteria->id;
            $titulo = $loteria->titulo;
            $descripcion = $loteria->descripcion;

            $html .= "<tr class='border-dotted'>";
            $html .= "<td class='text-center'>$cont</td>";
            $html .= "<td class='text-center'>$titulo</td>";
            $html .= "<td class='text-center'>$descripcion</td>";
            $html .= "<td class='text-center'><a id='$id' href='#' class='btn btn-info'data-toggle='modal' data-target='#modalConfirmarLoteria'>Seleccionar</a>";
            $html .= "</tr>";
        }

        $html .= "</tbody>
                </table>";

        return Response::json(array('html' => $html,));
    }

    // mostrar el titulo
    public function mostrarTituloDeLoteria(Request $request)
    {
        $id = $_GET['id'];
        $html = "";

        $loterias = Loteria::where('id', $id)
                            ->get();

        foreach ($loterias as $loteria) {
            $titulo = $loteria->titulo;
        }

        $html = "<h2 class='text-center'>Esta seguro de seleccionar la loteria"." '".$titulo."' "."como la actual?</h2>";
        
        return Response::json(array('html' => $html));
    }

    // mostrar loteria actual
    public function mostrarLoteriaActiva(Request $request)
    {
        $html = "";
        $boleanActual = False;

        $loterias = Loteria::where('activo', "Verdadero")
                            ->get();

        foreach ($loterias as $loteria) {
            $boleanActual = True;
            $titulo = $loteria->titulo;
        }

        if($boleanActual == True){
            $html = "<h2 class='text-center'>Loteria activa: $titulo</h2>";
        }else{
            $html = "<h2 class='text-center'>No se ha seleccionado una loteria</h2>";
        }
        
        return Response::json(array('html' => $html));
    }

     // mostrar el titulo
    public function seleccionarLoteria(Request $request)
    {
        $html = "";
        $idLoteria = null;

        if($request->session()->get("idLoteria")){
            $idLoteria = $request->session()->get("idLoteria");
        }        

        $loterias = Loteria::find($idLoteria);
        $loterias->activo = "Verdadero";
        $loterias->save();

        $loterias = Loteria::where('id','!=',$idLoteria)
                            ->get();

        foreach ($loterias as $loteria) {
            $id = $loteria->id;
            $loterias = Loteria::find($id);
            $loterias->activo = "Falso";
            $loterias->save();
        }

        $html = "<h4>Se ha seleccionado la loteria con éxito</h4>";
        
        return Response::json(array('html' => $html));
    }

    // mostrar el titulo
    public function mostrarInformacionDelPago(Request $request)
    {
        $id = $_GET['id'];
        $html = "";

        $numeros = Numero::where('id', $id)
                            ->get();

        foreach ($numeros as $numero) {
            $idUsuario = $numero->user_id;
            $pago = $numero->pago;      
            $numero = $numero->numero;      
        }

        if($pago == "Verdadero"){

            $usuarios = User::where('id', $idUsuario)
                            ->get();

            foreach ($usuarios as $usuario) {
                $name = $usuario->name;    
            }

            $pagos = Pago::where('numero_id', $id)
                            ->get();

            foreach ($pagos as $pago) {
                $fecha = $pago->created_at;    
            }

            $html = "<h2 class='text-center'>El usuario $name seleccionó el numero $numero</h2>";
            $html .= "<p class='text-center'>Fecha del pago: $fecha</p>";
        }else{
            $html = "<h2 class='text-center'>El numero $numero esta disponible</h2>";
        }
  
        return Response::json(array('html' => $html));
    }

}
