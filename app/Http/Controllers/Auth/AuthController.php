<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return Inertia::render('Auth/Login');
    }


    public function signIn(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return Redirect::route('admin.index')->with(
                [
                    'message' => 'Ingresando',
                    'status' => true,
                ]
            );
        }

        return back()->with([
            'message' => 'Credenciales incorrectas.',
            'status' => false
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::route('auth.login');
    }
}
