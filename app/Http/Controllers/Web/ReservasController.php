<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\CotizacionEmail;
use App\Models\Cliente;
use App\Models\Mensaje;
use App\Models\Reserva;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReservasController extends Controller
{

    public function store(Request $request)
    {
        // rango: null,
        $reserva = [];
        $cliente_exist =  Cliente::where('correo', $request->correo)->where('celular', $request->celular)->first();


        if (!$cliente_exist) {


            $cliente = [
                'r_social' => $request->para == 'Empresa' ? $request->r_social : $request->nombres . ' ' . $request->apellidos,
                'nombre' =>  $request->nombres,
                'num_doc' =>  $request->ruc,
                'apellidos' => $request->apellidos,
                'correo' =>  $request->correo,
                'celular' =>  $request->celular,
                'publico' =>  0,
                'estado' =>  0,
            ];



            $cliente_nuevo =  Cliente::create($cliente);
            $reserva['cliente'] = $cliente_nuevo->id;
        } else {
            $reserva['cliente'] = $cliente_exist->id;
        }

        $reserva['producto'] = $request->producto;
        //$reserva['fecha_ini'] = $request->correo;
        //$reserva['fecha_fin'] = $request->correo;

        $reserva['sede'] = $request->sede;
        $reserva['mensaje'] = $request->mensaje;
        $reserva['tipo'] = $request->tipo;
        //$reserva[''] = $request->tipo;

        Reserva::create($reserva);

        return back();
    }

    public  function mdgContacto(Request $request)
    {

        $message = [
            'nombre' => $request->nombres . ' ' . $request->apellidos,
            'correo' => $request->nombres,
            'celular' => $request->celular,
            'mensaje' => $request->mensaje,
        ];

        Mensaje::create($request->all());

        Mail::to('nearlino20@gmail.com')->send(new CotizacionEmail($message));
    }

   
}
