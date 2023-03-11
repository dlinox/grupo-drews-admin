<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'r_social',
        'num_doc',
        'tipo_doc',
        'logo',
        'nombre',
        'apellidos',
        'correo',
        'celular',
        'publico', // se muestra o no en la we
        'web', // link de su pagina web 
    ];
}
