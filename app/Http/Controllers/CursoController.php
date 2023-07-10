<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CursoController extends Controller
{
    //
    public function index()
{
    $cursos = DB::table('curso')
        ->select('id', 'grado', 'nivel', 'turno', 'cupo')
        ->get();

    return view('frm_cursos')->with('cursos', $cursos);
}

public function store(Request $request)
{
    if ($request->id == 0) {
        DB::table('curso')->insert([
            'grado' => $request->grado,
            'nivel' => $request->nivel,
            'turno' => $request->turno,
            'cupo' => $request->cupo,
        ]);
    } else {
        DB::table('curso')
            ->where('id', $request->id)
            ->update([
                'grado' => $request->grado,
                'nivel' => $request->nivel,
                'turno' => $request->turno,
                'cupo' => $request->cupo,
            ]);
    }

    $cursos = DB::table('curso')->get();
    return redirect()->route('cursos')->with('cursos', $cursos);
}

public function delete(Request $request)
{
    DB::table('curso')->where('id', $request->id)->delete();

    $cursos = DB::table('curso')->get();
    return redirect()->route('cursos')->with('cursos', $cursos);
}


}
