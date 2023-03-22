<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoriasController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->search ?? '';
        $categorias = Categoria::select('id', 'detalle')
            ->orWhere('detalle', 'LIKE', '%' . $search . '%')
            ->paginate(10);

        return Inertia::render('Administrador/Categorias/index', [
            'filters' => $request->all('search'),
            'categorias' => $categorias
        ]);
        
    }

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

    public function update(Request $request, string $id)
    {

        $validated = $this->validate(
            $request,
            [
                'detalle' => 'required|unique:categorias,detalle,' . $id,
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

    public function destroy(string $id)
    {
        Categoria::find($id)->delete();
        return back();
    }
}
