<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

use Inertia\Inertia;

class UsuarioController extends Controller
{


    public function index(Request $request)
    {

        $search = $request->search ?? '';

        $usuarios = User::select('id', 'name', 'email')
            ->orWhere('name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->paginate(10);

        return Inertia::render('Administrador/Usuarios/index',  [
            'filters' => $request->all('search'),
            'usuarios' => $usuarios
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $validated = $request->validated();
        if ($validated) {
            User::create($request->all());
        }
        return back()->withInput($request->all());
        //return response()->json($request);

    }

    public function update(UpdateUserRequest $request, string $id)
    {

        $validated = $request->validated();
        if ($validated) {
            User::find($id)->update($request->only('name', 'email'));
        }
        return back()->withInput($request->all());
    }

    public function destroy(string $id)
    {
        User::find($id)->delete();

        return back();
    }
}
