<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Configuracion;
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
        $categorias = Categoria::all(['id', 'detalle']);
        return Inertia::render('Administrador/Productos/Formulario', [
            'categorias' => $categorias
        ]);
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


        $producto = Producto::create($data);
        if ($producto) {
            Configuracion::actualizarWeb();
        }
        return redirect('/admin/productos');
        //return response()->json($request);

    }

    public function update(Request $request, string $id)
    {
        $producto  = Producto::find($id)->update($request->all());

        if ($producto) {
            Configuracion::actualizarWeb();
        }

        return back()->withInput($request->all());
    }

    public function destroy(string $id)
    {
        $producto = Producto::find($id)->delete();
        if ($producto) {
            Configuracion::actualizarWeb();
        }
        return back();
    }
}
