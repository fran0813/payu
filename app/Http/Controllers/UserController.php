<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Mail;
use Session;
use Redirect;
use \Response;
use App\Loteria;
use App\Numero;
use App\Pago;
use App\User;
use App\Check;

class UserController extends Controller
{
    public function index()
    {
    	return view('user.index');
    }

    public function seleccionarNumeros()
    {
    	return view('user.seleccionarNumeros');
    }

    // Verificar que una loteria este activa
    public function verificarLoteria(Request $request)
    {
        $html = "";
        $boleanActual = False;

        $loterias = Loteria::where('activo', "Verdadero")
                            ->get();

        foreach ($loterias as $loteria) {
            $boleanActual = True;
        }
        
        return Response::json(array('html' => $boleanActual,));
    }

    // Verificar que el usuario ya este en participación en la loteria
    public function verificarUsuario(Request $request)
    {
        $idUsuario = Auth::user()->id;
        $html = "";
        $tempNumero = "";
        $tempNumero2 = "";
        $contNumero = 0;
        $booleanVerificar = True;

        $loterias = Loteria::where('activo', "Verdadero")
                            ->get();

        foreach ($loterias as $loteria) {
            $idLoteria = $loteria->id;
        }

        $numeros = Numero::where('user_id', $idUsuario)
                            ->where('loteria_id', $idLoteria)
                            ->get();

        foreach ($numeros as $numero) {
            $contNumero++;
            $numero = $numero->numero;

            if($contNumero == 1){
                $tempNumero = "<p class='text-center'>$numero</p>";
            }else if($contNumero == 2){
        	   $tempNumero2 = "<p class='text-center'>$numero</p>";
            }

            if($contNumero > 1){
            	$booleanVerificar = False;
            }
        }

        if($booleanVerificar == False){
        	$html = "<h4 class='text-center'>Lo sentimos ya ha seleccionado los 2 numeros</h4>";
        	$html .= "<h4 class='text-center'>$tempNumero</h4>";
        	$html .= "<h4 class='text-center'>$tempNumero2</h4>";
        }
        
        return Response::json(array('html' => $html, 'booleanVerificar' => $booleanVerificar,));
    }

    // Verificar los numeros que selecciona el usuario
    public function verificarNumeros(Request $request)
    {
        $idUsuario = Auth::user()->id;
        $numero = $_POST['numero'];
        $formato = str_pad($numero, 5, "0", STR_PAD_LEFT);
        $html = "";
        $contNumero = 0;
        $contNumero2 = 0;
        $booleanVerificar = True;
        $booleanFormato = False;
        $booleanMax2 = True;
        $tempNumero = "";
        $tempNumero2 = "";

        $loterias = Loteria::where('activo', "Verdadero")
                            ->get();

        foreach ($loterias as $loteria) {
            $idLoteria = $loteria->id;
        }

        $numeros = Numero::->where('numero', $formato)
        					->where('pago', "Verdadero")
                            ->where('loteria_id', $idLoteria)
                            ->get();

        foreach ($numeros as $numero) {
        	$numeroSeleccionado = $numero->numero;
            $booleanVerificar = False;
        }

        $verificarNumeros = Numero::where('numero', $formato)
                            ->get();

        foreach ($verificarNumeros as $verificarNumero) {
        	$idNumero = $verificarNumero->id;
            $booleanFormato = True;
        }

        $numeros = Numero::where('user_id', $idUsuario)
                            ->get();

        foreach ($numeros as $numero) {
            $contNumero++;        
        }

        if($booleanVerificar == False){
        	$html = "<h4>Lo sentimos, ya han seleccionado el número $numeroSeleccionado</h4>";
        }else if($booleanFormato == False){
        	$html = "<h4>Lo sentimos, ese número no esta permitido $numero</h4>";
        }else{

	        if($booleanMax2 == True){

	        	$numeros = Numero::find($idNumero);
	        	$numeros->user_id = $idUsuario;
	        	$numeros->pago = "Verdadero";
	        	$numeros->save();

	        	$pagos = new Pago;
	        	$pagos->numero_id = $idNumero;
	        	$pagos->save(); 

                if($contNumero > 0){
                    $booleanMax2 = False;
                }

                if($booleanMax2 == False){
                     $numeros = Numero::where('user_id', $idUsuario)
                            ->get();

                    foreach ($numeros as $numero) {
                        $contNumero2++;
                        $numeroEnviar = $numero->numero;

                        if($contNumero2 == 1){
                            $tempNumero = $numeroEnviar;
                        }else if($contNumero2 == 2){
                            $tempNumero2 = $numeroEnviar;
                        }      
                    }

                    $html = "<h4>Ya ha seleccionado los 2 números para la loteria</h4>";
                }

	        	$html = "<h4>se ha seleccionado el numero numero $formato</h4>";
        	}else{
               $html = "<h4>Ya ha seleccionado los 2 números para la loteria</h4>";
        	}
        }
        
        return Response::json(array('html' => $html, 'booleanMax2' => $booleanMax2, 'tempNumero' => $tempNumero, 'tempNumero2' => $tempNumero2));
    }

    // Comprobar pago
    public function checkUser(Request $request)
    {
        $idUsuario = Auth::user()->id;

        $loterias = Loteria::where('activo', "Verdadero")
                            ->get();

        foreach ($loterias as $loteria) {
            $idLoteria = $loteria->id;
        }

        $checks = new Check;
        $checks->pago = "Verdadero";
        $checks->loteria_id = $idLoteria;
        $checks->user_id = $idUsuario;
        $checks->save();

        return Response::json(array('html' => "ok",));
    }

     // Verificar pago 
    public function verificarPago(Request $request)
    {
        $idUsuario = Auth::user()->id;
        $boolean = False;
        $idLoteria = null;

        $loterias = Loteria::where('activo', "Verdadero")
                            ->get();

        foreach ($loterias as $loteria) {
            $idLoteria = $loteria->id;
        }

        if($idLoteria != null){

            $checks = Check::where('pago', "Verdadero")
                            ->where('loteria_id', $idLoteria)
                            ->where('user_id', $idUsuario)
                            ->get();

            foreach ($checks as $check) {
                $boolean = True;
            }

        }

        return Response::json(array('booleanVerificar' => $boolean,));
    }

    // Envia correo
    public function correo(Request $request)
    {
        Mail::send('emails.mail', $request->all(), function($msj){
            $msj->subject('Bienvenido a Fundadif actividad lúdica');
            $msj->to(Auth::user()->email);
        });

        
        $html = "<h2>Se ha enviado un correo con los números seleccionados</h2>";
        $html .= "<h4>Por favor revisar la carpeta de spam</h4>";

        return Response::json(array('html' => $html,));
    }
}
