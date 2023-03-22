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
            'imagenes'
        );


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

    public function edit(string $id)
    {
        $res = Producto::find($id);

        return Inertia::render('Administrador/Productos/Formulario', ['producto' => $res]);
    }

    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'imagenes.*' => 'nullable|mimes:jpg,jpeg,png|max:20000',
                'detalle.*' => 'required',
                'descripcion.*' => 'required',
            ],
            [
                //'imagenes.*.required' => 'Please upload an image',
                'imagenes.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                'imagenes.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
                'detalle.required' => 'El detalle es obligatorio',
                'descripcion.required' => 'La descripcion es obligatorio',
            ]
        );

     


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
            'aire_acondicionado' => $request->aire_acondicionado ?? false,
            'equipaje' => $request->equipaje,
            'contenido' => $request->contenido,
        ];


        if ($request->hasFile('imagenes.*')) {

            $imagenes = $request->imagenes;
            
            $path_imagenes = [];
            $cont = 1;
            foreach ($imagenes as $item) {
                $fileName = time() . '-img-' . $cont . '.' . $item->extension();
                $item->move(public_path('uploads/productos/'), $fileName);
                array_push($path_imagenes,  $fileName);
                $cont++;
            }

            $data['imagenes'] = implode(',', $path_imagenes);
        }

        if ($request->id) {
            $servicio = Producto::find($request->id);

            if (!$servicio) {
                //TODO: Crear un trow para el error.
                return back()->withErrors(['msg' => 'Eñ Producto no existe']);
            }


            if ($servicio->update($data)) {
                Configuracion::actualizarWeb();
                return redirect('/admin/productos');
                return back();
            }
        } else {

            $producto = Producto::create($data);
            if ($producto) {
                Configuracion::actualizarWeb();
            }
            return redirect('/admin/productos');
        }

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
