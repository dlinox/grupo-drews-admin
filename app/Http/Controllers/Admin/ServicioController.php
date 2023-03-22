<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuracion;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServicioController extends Controller
{

    public function index(Request $request)
    {

        $search = $request->search ?? '';

        $servicios = Servicio::select('id', 'titulo', 'descripcion', 'figura', 'detalles')
            ->orWhere('titulo', 'LIKE', '%' . $search . '%')
            ->orWhere('descripcion', 'LIKE', '%' . $search . '%')
            ->paginate(10);

        return Inertia::render('Administrador/Servicios/index',  [
            'filters' => $request->all('search'),
            'servicios' => $servicios
        ]);


    }

    public function create() //FORMULARIO PARA CREAR SERVICIO
    {
        return Inertia::render('Administrador/Servicios/Formulario');
    }


    public function store(Request $request)
    {

        if ($request->id) {

            if ($this->actualizar($request, $request->id)) { //Todo: Pasar al modelo 
                return redirect('/admin/servicios');
                return back();
            }

            //return;
        } else {
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
        }


        //admin.servicios.index
        //return response()->json($request);

    }

    public function edit(string $id)
    {
        $res = Servicio::find($id);

        return Inertia::render('Administrador/Servicios/Formulario', ['servicio' => $res]);
    }

    public function update(Request $request, string $id)
    { //metodo put no funciona con imagenes

        $servicio = Servicio::find($id);

        if (!$servicio) {
            //TODO: Crear un trow para el error.
            return back()->withErrors(['msg' => $id]);
        }

        $validate =  $this->validate(
            $request,
            [
                'imagenes.*' => 'nullable|mimes:jpg,jpeg,png|max:5000',
                'titulo' => 'required',
                'descripcion' => 'required',
                'figura' => 'required',
            ],
            [
                //'imagenes.*.required' => 'Please upload an image',
                'imagenes.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                'imagenes.*.max' => 'Sorry! Maximum allowed size for an image is 5MB',
                'titulo.required' => 'El titulo es obligatorio',
                'descripcion.required' => 'La descripcion es obligatorio',
                'figura.required' => 'La figura es obligatorio',
            ]
        );

        if ($validate) {

            $data = [
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'figura' => $request->figura,
                'contenido' => $request->contenido,
                'detalles' => $request->detalles,
            ];

            if ($request->hasFile('imagenes.*')) {
                $imagenes = $request->imagenes;
                $path_imagenes = [];

                $cont = 1;
                foreach ($imagenes as $item) {
                    $fileName = time() . '-img-' . $cont . '.' . $item->extension();
                    $item->move(public_path('uploads/servicios/'), $fileName);
                    array_push($path_imagenes,  $fileName);
                    $cont++;
                }
                $data['imagenes'] = implode(',', $path_imagenes);
            }

            if ($servicio->update($data)) {
                Configuracion::actualizarWeb();
                return redirect('/admin/servicios');
                return back();
            }

            return back()->withErrors(['msg' => 'The Message']);
        }
    }

    public function actualizar(Request $request, string $id)
    {

        $servicio = Servicio::find($id);

        if (!$servicio) {
            //TODO: Crear un trow para el error.
            return back()->withErrors(['msg' => $id]);
        }

        $validate =  $this->validate(
            $request,
            [
                'imagenes.*' => 'nullable|mimes:jpg,jpeg,png|max:5000',
                'titulo' => 'required',
                'descripcion' => 'required',
                'figura' => 'required',
            ],
            [
                //'imagenes.*.required' => 'Please upload an image',
                'imagenes.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                'imagenes.*.max' => 'Sorry! Maximum allowed size for an image is 5MB',
                'titulo.required' => 'El titulo es obligatorio',
                'descripcion.required' => 'La descripcion es obligatorio',
                'figura.required' => 'La figura es obligatorio',
            ]
        );

        if ($validate) {

            $data = [
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'figura' => $request->figura,
                'contenido' => $request->contenido,
                'detalles' => $request->detalles,
            ];

            if ($request->hasFile('imagenes.*')) {
                $imagenes = $request->imagenes;
                $path_imagenes = [];

                $cont = 1;
                foreach ($imagenes as $item) {
                    $fileName = time() . '-img-' . $cont . '.' . $item->extension();
                    $item->move(public_path('uploads/servicios/'), $fileName);
                    array_push($path_imagenes,  $fileName);
                    $cont++;
                }
                $data['imagenes'] = implode(',', $path_imagenes);
            }

            if ($servicio->update($data)) {
                Configuracion::actualizarWeb();
                return true;
            }

            return back()->withErrors(['msg' => 'The Message']);
        }
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
