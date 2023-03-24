<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;


    protected $fillable = [
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
        'imagenes',
        'seguridad', //
        'tipo_v', //
    ];


    protected function imagenes(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $name_files =  explode(',', $value);
                $array_aux = [];

                foreach ($name_files as  $item) {
                    $temp = env('APP_URL', 'http://localhost') . 'uploads/productos/' . $item;
                    array_push($array_aux, $temp);
                }
                return $array_aux;
            },
        );
    }


    protected function seguridad(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => explode('|-|', $value),
            set: fn ($value) => implode('|-|', $value),
        );
    }
}
