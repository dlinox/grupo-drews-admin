<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuracion;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServicioController extends Controller
{

    public function index()
    {
        $servicios = Servicio::all(['id', 'titulo', 'descripcion', 'figura', 'detalles']);

        return Inertia::render('Administrador/Servicios/index', [
            'servicios' => $servicios
        ]);
    }

    public function create() //FORMULARIO PARA CREAR SERVICIO
    {
        return Inertia::render('Administrador/Servicios/Formulario');
    }


    public function store(Request $request)
    {
        $validate =  $this->validate(
            $request,
            [
                'imagenes.*' => 'required|mimes:jpg,jpeg,png|max:20000',
                'titulo' => 'required',
                'descripcion' => 'required',
                'figura' => 'required',
            ],
            [
                'imagenes.*.required' => 'Please upload an image',
                'imagenes.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                'imagenes.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
                'titulo.required' => 'El titulo es obligatorio',
                'descripcion.required' => 'La descripcion es obligatorio',
                'figura.required' => 'La figura es obligatorio',
            ]
        );


        if ($validate) {

            $imagenes = $request->imagenes;

            $path_imagenes = [];

            $cont = 1;
            foreach ($imagenes as $item) {
                $fileName = time() . '-img-' . $cont . '.' . $item->extension();
                $item->move(public_path('uploads/servicios/'), $fileName);
                array_push($path_imagenes,  $fileName);
                $cont++;
            }

            $data = [
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'figura' => $request->figura,
                'contenido' => $request->contenido,
                'detalles' => $request->detalles,
                'imagenes' => implode(',', $path_imagenes),
            ];
            $res = Servicio::create($data);

            if ($res) {
                Configuracion::actualizarWeb();
            }

            return redirect('/admin/servicios');
            return back();
        }



        //admin.servicios.index
        //return response()->json($request);

    }

    public function update(Request $request, string $id)
    {
        $res = Servicio::find($id)->update($request->only('titulo', 'descripcion', 'figura'));


        if ($res) {
            Configuracion::actualizarWeb();
        }
        return back()->withInput($request->all());
    }

    public function destroy(string $id)
    {
        $res = Servicio::find($id)->delete();

        if ($res) {
            Configuracion::actualizarWeb();
        }
        return back();
    }
}
