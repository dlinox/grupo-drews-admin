<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Configuracion extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_logo',
        'web_url',
        'web_nombre',
        'web_descripcion',
        'web_telefonos',
        'web_celulares',
        'web_direcciones',
        'web_whatsapp',
        'web_correo',
        'web_mision',
        'web_vision',
        'web_social_facebook',
        'web_social_instagram',
        'web_social_youtube',
        'web_social_twitter',
        'web_update',

    ];

    static public function actualizarWeb()
    {
        Configuracion::where('id', 1)->update(['web_update' => Uuid::uuid4()]);
    }

    static public function getData()
    {
        $res = Configuracion::first();
        $configuracion = [
            'logo' => $res->web_logo,
            'url' => $res->web_url,
            'nombre' => $res->web_nombre,
            'descripcion' => $res->web_descripcion,
            'whatsapp' => $res->web_whatsapp,
            'correo' => $res->web_correo,
            'mision' => $res->web_mision ?? "",
            'vision' => $res->web_vision ?? "",
            'social_facebook' => $res->web_social_facebook,
            'social_instagram' => $res->web_social_instagram,
            'social_youtube' => $res->web_social_youtube,
            'social_twitter' => $res->web_social_twitter,
            'sedes' => Sede::all(['id', 'ubigeo', 'direccion', 'telefono', 'celulares', 'principal', 'estado']),

        ];
        return $configuracion;
    }
}
