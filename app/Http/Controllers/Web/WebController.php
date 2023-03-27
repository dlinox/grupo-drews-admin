<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\Slider;
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
                'seguridad',
                'tipo_v'
            ]
        );
        $clientes = Cliente::select('id', 'r_social', 'logo')->where('publico', 1)->get();

        $sliders = Slider::all();
        return Inertia::render('Web/Inicio/index', [
            'servicios'  => $servicios,
            'vehiculos' => $vehiculos,
            'clientes' => $clientes,
            'sliders' => $sliders
        ]);
    }

    public function pageServicios()
    {
        $servicios  = Servicio::all();
        return Inertia::render('Web/Servicios/index',  ['servicios' => $servicios]);
    }

    public function pageClientes()
    {
        $clientes = Cliente::select('id', 'r_social', 'logo')->where('publico', 1)->get();

        return Inertia::render('Web/Clientes/index',  ['clientes' => $clientes]);
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
                'seguridad',
                'tipo_v'
            ]
        );

        $categorias = Categoria::all('id', 'detalle');
        return Inertia::render('Web/Vehiculos/index',  ['vehiculos' => $vehiculos, 'categorias' => $categorias]);
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
