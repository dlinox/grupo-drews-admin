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
}
