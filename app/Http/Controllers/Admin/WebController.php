<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuracion;
use App\Models\Sede;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WebController extends Controller
{

    public function index()
    {
        $res = Configuracion::first();
        $configuracion = [
            'web_logo' => $res->web_logo,
            'web_url' => $res->web_url,
            'web_nombre' => $res->web_nombre,
            'web_descripcion' => $res->web_descripcion,
            // 'web_telefonos' =>  $res->web_telefonos ?  explode('**', $res->web_telefonos) : [],
            // 'web_celulares' =>  $res->web_celulares ?  explode('**', $res->web_celulares) : [],
            // 'web_direcciones' =>  $res->web_direcciones ?  explode('**', $res->web_direcciones) : [],
            'web_whatsapp' => $res->web_whatsapp,
            'web_correo' => $res->web_correo,
            'web_mision' => $res->web_mision ?? "",
            'web_vision' => $res->web_vision ?? "",
            'web_social_facebook' => $res->web_social_facebook,
            'web_social_instagram' => $res->web_social_instagram,
            'web_social_youtube' => $res->web_social_youtube,
            'web_social_twitter' => $res->web_social_twitter,
            'sedes' => Sede::all(['id', 'ubigeo', 'direccion', 'telefono', 'celulares', 'principal', 'estado']),

        ];
        return Inertia::render('Administrador/Web/index', ['configuracion' => $configuracion]);
    }

    public function updateLogo(Request $request)
    {
        $res = Configuracion::find(1);

        if ($request->file('logo')) {
            $file_name = 'logo' . '.' . $request->logo->extension();
            $request->logo->move(public_path('uploads'), $file_name);
            $res->web_logo = env('APP_URL', 'http://localhost') . 'uploads/' . $file_name;

            if ($res->save()) {
                Configuracion::actualizarWeb();
            }
        }
        return back();
    }

    public function store(Request $request)
    {
        $res = Configuracion::find(1);
        $configuracion = [
            'web_url' => $request->web_url,
            'web_nombre' => $request->web_nombre,
            'web_descripcion' => $request->web_descripcion,
            // 'web_telefonos' =>  count($request->web_telefonos) > 0 ?  implode('**', $request->web_telefonos) : null,
            // 'web_celulares' =>  count($request->web_celulares) > 0 ?  implode('**', $request->web_celulares) : null,
            // 'web_direcciones' =>  count($request->web_direcciones) > 0 ?  implode('**', $request->web_direcciones) : null,
            'web_whatsapp' => $request->web_whatsapp,
            'web_correo' => $request->web_correo,
            'web_mision' => $request->web_mision,
            'web_vision' => $request->web_vision,
            'web_social_facebook' => $request->web_social_facebook,
            'web_social_instagram' => $request->web_social_instagram,
            'web_social_youtube' => $request->web_social_youtube,
            'web_social_twitter' => $request->web_social_twitter,
        ];

        if ($res->update($configuracion)) {
            Configuracion::actualizarWeb();
        }

        return back()->withInput($request->all());
        //return response()->json($request);
    }
}
