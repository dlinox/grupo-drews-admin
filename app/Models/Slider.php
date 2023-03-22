<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'sub_titulo',
        'src',
        'tipo',
        'grupo',
    ];

    protected function src(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? env('APP_URL', 'http://localhost') . $value : null,
        );
    }
}
