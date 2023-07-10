<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login(Request $request){
        $credenciales=[
            'name'=> $request->name,
            'password'=> $request->password,
        ];

        if(Auth::attempt($credenciales)){// inicio sesion correcto
            $request->session()->regenerate();
            return redirect()->intended(route('inicio'));
        }else{
            return redirect()->route('login_usuario');
        }
    }

    public function logout(Request $request){
        Auth::Logout();// Laravel cierra la sesión
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login_usuario');
    }
}
