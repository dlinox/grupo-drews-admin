<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WebController extends Controller
{


    public function pageInicio()
    {
        return Inertia::render('Web/Inicio/index');
    }

    public function pageVehiculos()
    {
        return Inertia::render('Web/Vehiculos/index');
    }

    public function pageNosotros()
    {
        return Inertia::render('Web/Nosotros/index');
    }

    public function pageServicios()
    {
        return Inertia::render('Web/Servicios/index');
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
