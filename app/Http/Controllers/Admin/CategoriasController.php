<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categorias = Categoria::all(['id', 'detalle']);
        return Inertia::render('Administrador/Categorias/index', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated  = $this->validate(
            $request,
            [
                'detalle' => 'required|unique:categorias',
            ],
            [
                'detalle.required' => 'El Nombre es obligatorio',
                'detalle.unique' => 'La categoria ya existe',
            ]
        );


        if ($validated) {
            Categoria::create($request->all());
        }
        return back()->withInput($request->all());
        //return response()->json($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $this->validate(
            $request,
            [
                'detalle' => 'required|unique:categorias,detalle,'. $id ,
            ],
            [
                'detalle.required' => 'El Nombre es obligatorio',
                'detalle.unique' => 'La categoria ya existe',
            ]
        );

        if ($validated) {
            Categoria::find($id)->update($request->only('detalle'));
        }
        return back()->withInput($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Categoria::find($id)->delete();

        return back();
    }
}
