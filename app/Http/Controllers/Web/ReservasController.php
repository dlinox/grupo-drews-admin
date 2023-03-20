<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Reserva;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ReservasController extends Controller
{

    public function store(Request $request)
    {
        // rango: null,
        $reserva = [];
        $cliente_exist =  Cliente::where('correo', $request->correo)->where('celular', $request->celular)->first();
        

        if (!$cliente_exist) {

            $cliente = [
                'r_social' => $request->nombres . ' ' . $request->apellidos,
                'nombre' =>  $request->nombres,
                'apellidos' => $request->apellidos,
                'correo' =>  $request->correo,
                'celular' =>  $request->celular,
                'publico' =>  0,
                'estado' =>  0
            ];

            $cliente_nuevo =  Cliente::create($cliente);
            $reserva['cliente'] = $cliente_nuevo->id;
        }
        else{
            $reserva['cliente'] = $cliente_exist->id;
        }

        $reserva['producto'] = $request->producto;
        //$reserva['fecha_ini'] = $request->correo;
        //$reserva['fecha_fin'] = $request->correo;

        $reserva['sede'] = $request->sede;
        $reserva['tipo'] = $request->tipo;

        Reserva::create($reserva);

        return back();
    }
}