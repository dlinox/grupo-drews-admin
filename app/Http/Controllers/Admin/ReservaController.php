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

    public function index(Request $request)
    {

        $search = $request->search ?? '';

        $reservas  = Reserva::select(
            'reservas.*',
            'productos.detalle',
            'servicios.titulo',
            'clientes.r_social',
            'clientes.celular',
            'clientes.correo'
        )
            ->join('clientes', 'clientes.id', '=', 'reservas.cliente')
            ->leftjoin('productos', 'productos.id', '=', 'reservas.producto')
            ->leftjoin('servicios', 'servicios.id', '=', 'reservas.producto')
            ->orWhere('productos.detalle', 'LIKE', '%' . $search . '%')
            ->orWhere('servicios.titulo', 'LIKE', '%' . $search . '%')
            ->orWhere('clientes.r_social', 'LIKE', '%' . $search . '%')
            ->orWhere('clientes.celular', 'LIKE', '%' . $search . '%')
            ->orWhere('clientes.correo', 'LIKE', '%' . $search . '%')
            ->paginate(10);


        return Inertia::render('Administrador/Reservas/index',  [
            'filters' => $request->all('search'),
            'reservas' => $reservas
        ]);
    }
}
/**
 * 
 *  $search = $request->search ?? '';

       
 */
