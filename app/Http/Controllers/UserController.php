<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function formlogin()
    {
        return view('login');
    }


    public function login()
    {
        $validados = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $usuario = DB::table('users')
        -> where('email',$validados['email'])
        ->where('password', $validados['password']);

        if ($usuario->exists()) {
            //Crea la variable de sesión
            session(['usuario' => $validados['email']]);
            return redirect('/')->with('succes', 'El usuario ha iniciado sesión.');
        }
        return redirect()->back()->with('fault', 'Usuario o contraseña incorrectos.');
    }


    public function logout()
    {   //Pregunta si existe la variable de sesión y la borra
        if(request()->session()->has('usuario')){
            request()->session()->forget('usuario');
            return redirect('/')->with('succes', 'Sesión cerrada');
        }
        return redirect('/')->with('fault', 'No has iniciado sesión');
    }
}
