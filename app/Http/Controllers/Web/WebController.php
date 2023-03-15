<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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

    public function pageContactanos()
    {
        return Inertia::render('Web/Contactanos/index');
    }
}
