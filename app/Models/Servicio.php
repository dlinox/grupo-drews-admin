<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'figura',
        'contenido',
        'imagenes',
        'detalles',
    ];

    protected function detalles(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value),
        );
    }

    // public function getDetallesAttribute($value){
    //     $this->attributes['detalles'] = json_decode($value);
    // }

}
