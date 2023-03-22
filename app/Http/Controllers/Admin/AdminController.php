<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{

    public function index()
    {
        $vehiculos = Producto::count();
        $servicios = Servicio::count();
        $clientes = Cliente::count();
        $usuarios = User::count();

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
            ->limit(10)->get();



        return Inertia::render('Administrador/Dashboard', [
            'vehiculos' => $vehiculos,
            'servicios' => $servicios,
            'clientes' => $clientes,
            'usuarios' => $usuarios,

            'reservas' => $reservas
        ]);
    }
}
