<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WebController extends Controller
{
    public function pageInicio()
    {
        $servicios  = Servicio::all(['id', 'titulo', 'figura']);
        $vehiculos  = Producto::all(
            [
                'id',
                'detalle',
                'descripcion',
                'marca',
                'modelo',
                'categoria',
                'tipo',
                'combustible',
                'cilindrada',
                'puertas',
                'capacidad',
                'aire_acondicionado',
                'equipaje',
                'contenido',
                'imagenes',
            ]
        );
        return Inertia::render('Web/Inicio/index', [
            'servicios'  => $servicios,
            'vehiculos' => $vehiculos
        ]);
    }

    public function pageServicios()
    {
        $servicios  = Servicio::all();
        return Inertia::render('Web/Servicios/index',  ['servicios' => $servicios]);
    }

    public function pageVehiculos()
    {
        $vehiculos  = Producto::all(
            [
                'id',
                'detalle',
                'descripcion',
                'marca',
                'modelo',
                'categoria',
                'tipo',
                'combustible',
                'cilindrada',
                'puertas',
                'capacidad',
                'aire_acondicionado',
                'equipaje',
                'contenido',
                'imagenes',
            ]
        );
        return Inertia::render('Web/Vehiculos/index',  ['vehiculos' => $vehiculos]);
    }

    public function pageNosotros()
    {
        return Inertia::render('Web/Nosotros/index');
    }

    public function pageServicioDetalle($id)
    {

        return Inertia::render('Web/Servicios/detalle', ['servicio' => Servicio::find($id)]);
    }

    public function pageContactanos()
    {
        return Inertia::render('Web/Contactanos/index');
    }
}
