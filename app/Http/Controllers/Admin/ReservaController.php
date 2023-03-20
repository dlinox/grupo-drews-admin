<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Reserva;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservaController extends Controller
{

    public function index()
    {
        $reservas =  Reserva::select()->get()->map(function ($item) {

            return [
                "id" => $item->id,
                "tipo" => $item->tipo,
                "fecha_ini" => $item->fecha_ini,
                "fecha_fin" => $item->fecha_fin,
                "sede" => $item->sede,
                "producto" =>   $item->tipo == 'Vehiculo'
                    ? Producto::select('id', 'detalle')->where('id', $item->producto)->first()
                    : Servicio::select('id', 'titulo')->where('id', $item->producto)->first(),
                "cliente" => Cliente::select('id', 'r_social', 'celular', 'correo')->where('id', $item->cliente)->first(),

            ];
        });

        return Inertia::render('Administrador/Reservas/index', ['reservas' => $reservas]);
    }
}
