<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DocenteController extends Controller
{
    //
    public function index()
{
    $docentes = DB::table('docente')
        ->select('id', 'codigo', 'nombres', 'apellidos', 'sexo', 'direccion', 'fecha_nac', 'telefono', 'profesion')
        ->get();

    return view('frm_docentes')->with('docentes', $docentes);
}

public function store(Request $request)
{
    if ($request->id == 0) {
        DB::table('docente')->insert([
            'codigo' => $request->codigo,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'sexo' => $request->sexo,
            'direccion' => $request->direccion,
            'fecha_nac' => $request->fecha_nac,
            'telefono' => $request->telefono,
            'profesion' => $request->profesion,
        ]);
    } else {
        DB::table('docente')
            ->where('id', $request->id)
            ->update([
                'codigo' => $request->codigo,
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'sexo' => $request->sexo,
                'direccion' => $request->direccion,
                'fecha_nac' => $request->fecha_nac,
                'telefono' => $request->telefono,
                'profesion' => $request->profesion,
            ]);
    }

    $docentes = DB::table('docente')->get();
    return redirect()->route('docentes')->with('docentes', $docentes);
}

public function delete(Request $request)
{
    DB::table('docente')->where('id', $request->id)->delete();

    $docentes = DB::table('docente')->get();
    return redirect()->route('docentes')->with('docentes', $docentes);
}


}
