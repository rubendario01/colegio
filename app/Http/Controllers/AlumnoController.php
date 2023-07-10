<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AlumnoController extends Controller
{
    //
    public function index()
    {
        $alumnos = DB::table('alumno')
            ->select('id', 'ci_alumno', 'nombre', 'apellidos', 'rude', 'fecha_nac', 'sexo', 'direccion')
            ->get();
        
        return view('frm_alumnos')->with('alumnos', $alumnos);
    }
    
    public function store(Request $request)
    {
        if ($request->id == 0) {
            DB::table('alumno')->insert([
                'ci_alumno' => $request->ci_alumno,
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'rude' => $request->rude,
                'fecha_nac' => $request->fecha_nac,
                'sexo' => $request->sexo,
                'direccion' => $request->direccion,
            ]);
        } else {
            DB::table('alumno')
                ->where('id', $request->id)
                ->update([
                    'ci_alumno' => $request->ci_alumno,
                    'nombre' => $request->nombre,
                    'apellidos' => $request->apellidos,
                    'rude' => $request->rude,
                    'fecha_nac' => $request->fecha_nac,
                    'sexo' => $request->sexo,
                    'direccion' => $request->direccion,
                ]);
        }
    
        $alumnos = DB::table('alumno')->get();
        return redirect()->route('alumnos')->with('alumnos', $alumnos);
    }
    
    public function delete(Request $request)
    {
        DB::table('alumno')->where('id', $request->id)->delete();
    
        $alumnos = DB::table('alumno')->get();
        return redirect()->route('alumnos')->with('alumnos', $alumnos);
    }

}
