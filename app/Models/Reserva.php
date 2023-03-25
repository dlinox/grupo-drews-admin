<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto',
        'fecha_ini',
        'fecha_fin',
        'sede',
        'cliente',
        'tipo',
        'mensaje',
        'estado',
    ];

    // protected function estado(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => $value ? true : ( $value == 0 ? false : 'E'  ) ,
    //         //set: fn ($value) => $value ? true ,
    //     );
    // }
}
