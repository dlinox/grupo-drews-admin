<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductoController extends Controller
{

    public function index()
    {

        $productos = Producto::all(
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
            'imagenes'
        )->map(function ($producto) {

            $producto->imagenes = explode(',', $producto->imagenes);
            return  $producto;
        });

        return Inertia::render('Administrador/Productos/index',  [
            'productos' => $productos
        ]);
    }

    public function create() //FORMULARIO PARA CREAR SERVICIO
    {
        return Inertia::render('Administrador/Productos/Formulario');
    }


    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'imagenes.*' => 'required|mimes:jpg,jpeg,png|max:20000',
                'detalle.*' => 'required',
                'descripcion.*' => 'required',
            ],
            [
                'imagenes.*.required' => 'Please upload an image',
                'imagenes.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                'imagenes.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
                'detalle.required' => 'El detalle es obligatorio',
                'descripcion.required' => 'La descripcion es obligatorio',
            ]
        );

        $imagenes = $request->imagenes;

        $path_imagenes = [];

        $cont = 1;
        foreach ($imagenes as $item) {
            $fileName = time() . '-img-' . $cont . '.' . $item->extension();
            $item->move(public_path('uploads/productos/'), $fileName);
            array_push($path_imagenes,  $fileName);
            $cont++;
        }

        $data = [
            'detalle' => $request->detalle,
            'descripcion' => $request->descripcion,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'categoria' => $request->categoria,
            'tipo' => $request->tipo,
            'combustible' => $request->combustible,
            'cilindrada' => $request->cilindrada,
            'puertas' => $request->puertas,
            'capacidad' => $request->capacidad,
            'aire_acondicionado' => $request->aire_acondicionado,
            'equipaje' => $request->equipaje,
            'contenido' => $request->contenido,
            'imagenes' => implode(',', $path_imagenes)
        ];

        Producto::create($data);
        return redirect('/admin/productos');
        //return response()->json($request);

    }

    public function update(Request $request, string $id)
    {
        Producto::find($id)->update($request->all());
        return back()->withInput($request->all());
    }

    public function destroy(string $id)
    {
        Producto::find($id)->delete();

        return back();
    }
}
