<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Configuracion;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all(['id', 'r_social', 'num_doc', 'logo']);
        return Inertia::render('Administrador/Clientes/index', ['clientes' => $clientes]);
    }

    public function store(Request $request)
    {
        $validated  =  $this->validate(
            $request,
            [
                'logo' => 'nullable|mimes:jpg,jpeg,png|max:2000',
                'r_social' => 'required',
            ],
            [
                'logo.mimes' => 'Solo se permiten imágenes jpeg, jpg y png',
                'logo.max' => '¡Lo siento! El tamaño máximo permitido para una imagen es de 2MB',
                'r_social.required' => 'R Rocial es obligatorio',
            ]
        );


        if ($validated) {

            $data = [
                'r_social' => $request->r_social,
                'num_doc' => $request->num_doc,
                'tipo_doc' => $request->tipo_doc,
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'web' => $request->web,
                'publico' => $request->publico,
            ];

            if ($request->file('logo')) {
                $file_name = Str::random(8) . '-' . time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('uploads/clientes/'), $file_name);

                $data['logo'] = 'uploads/clientes/' . $file_name;
            }

            Cliente::create($data);
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
                'detalle.required' => 'El Nombresss es obligatorio',
                'detalle.unique' => 'La categoria ya existe',
            ]
        );

        if ($validated) {
            Cliente::find($id)->update($request->only('detalle'));
        }
        return back()->withInput($request->all());
    }

    public function destroy(string $id)
    {
        Cliente::find($id)->delete();
        return back();
    }
}

/**
 * 
 * 'r_social',
        'num_doc',
        'tipo_doc',
        'logo',
        'nombre',
        'paterno',
        'materno',
        'correo',
        'celular',
        'publico', // se muestra o no en la we
        'web', // link de su pagina web 
 */
