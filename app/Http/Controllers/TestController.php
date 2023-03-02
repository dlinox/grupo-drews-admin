<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TestController extends Controller
{
    public function TestHome()
    {
        return Inertia::render('Home');
    }
}
