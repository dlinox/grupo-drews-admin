<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WebController extends Controller
{
    

    public function pageInicio( )
    {
        return Inertia::render('Web/Inicio/index');
    }
}
