<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;


class UsuarioController extends Controller
{
    //
    public function index(){
        $usuarios= DB::table('users')->join('rol', 'rol.id', '=', 'users.id_rol')
        ->select('users.id', 'users.name', 'rol.nombre as role', 'users.id_rol', 'users.email')
        ->get();
        $roles=DB::table('rol')->get();
        return view('frm_usuarios')->with(['usuarios'=>$usuarios, 'roles'=>$roles]);
    }

    public function store(Request $request){
        if($request->id==0){
            DB::table('users')->insert([
                'name'=>$request->nombre,
                'password'=>Hash::make($request->password),
                'email'=>$request->email,
                'id_rol'=> $request->id_rol,
            ]);

        }else{
            DB::table('users')->where('users.id', $request->id)->update([
                'name'=>$request->nombre,
                'password'=>Hash::make($request->password),
                'email'=>$request->email,
                'id_rol'=> $request->id_rol,
            ]);
        }
        $usuarios= DB::table('users')->get();
        return redirect()->route('usuarios')->with(['usuarios'=>$usuarios]);
    }

 

    public function delete(Request $request){
        $usuario = DB::table('users')->where('users.id', $request->id);
        $usuario->delete();
        $usuarios= DB::table('users')->get();
        return redirect()->route('usuarios')->with(['usuarios'=>$usuarios]);
    }

}
