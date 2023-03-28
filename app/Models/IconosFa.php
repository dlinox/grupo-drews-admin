<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IconosFa extends Model
{
    use HasFactory;

    protected $fillable = [
        'class',
        'name',
        'version',
    ];

    public function setNameAttribute($value)
    {
        $class_name = explode(' fa-', $value)[1];
        $name = explode('-', $class_name);

        $this->attributes['name'] = strtoupper(implode(' ', $name));
    }


    public function listIcons($search)
    {
        $_search = $request->search ?? '';
        $categorias = Categoria::select('id', 'detalle')
            ->orWhere('detalle', 'LIKE', '%' . $_search . '%')
            ->paginate(10);

        return Inertia::render('Administrador/Categorias/index', [
            'filters' => $request->all('search'),
            'categorias' => $categorias
        ]);
    }
}
