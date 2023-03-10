<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Configuracion;
use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ApiController extends Controller
{
    public function getData()
    {
        $productos  = Producto::all();
        $servicios  = Servicio::all();
        $configuraciones = Configuracion::first();

        $config = [
            'web_logo' => $configuraciones->web_logo,
            'web_url' => $configuraciones->web_url,
            'web_nombre' => $configuraciones->web_nombre,
            'web_descripcion' => $configuraciones->web_descripcion,
            'web_telefonos' =>  $configuraciones->web_telefonos ?  explode('**', $configuraciones->web_telefonos) : [],
            'web_celulares' =>  $configuraciones->web_celulares ?  explode('**', $configuraciones->web_celulares) : [],
            'web_direcciones' =>  $configuraciones->web_direcciones ?  explode('**', $configuraciones->web_direcciones) : [],
            'web_whatsapp' => $configuraciones->web_whatsapp,
            'web_correo' => $configuraciones->web_correo,
            'web_mision' => $configuraciones->web_mision ?? "",
            'web_vision' => $configuraciones->web_vision ?? "",
            'web_social_facebook' => $configuraciones->web_social_facebook,
            'web_social_instagram' => $configuraciones->web_social_instagram,
            'web_social_youtube' => $configuraciones->web_social_youtube,
            'web_social_twiter' => $configuraciones->web_social_twiter,
        ];

        return response()->json([
            'productos' => $productos,
            'servicios' => $servicios,
            'configuraciones' => $config,
        ]);
    }
}
 // $file = 'productos.text';
// $cadenaEncriptada = Crypt::encrypt($productos);
// file_put_contents($file, $cadenaEncriptada);
// $datos_encrypt = file_get_contents("productos.text");
// $datos_clientes =  decrypt($datos_encrypt);
// $json_clientes = json_decode($datos_clientes, true);