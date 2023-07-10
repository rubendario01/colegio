<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MateriaController extends Controller
{
    //
    public function index()
{
    $materias = DB::table('materia')
        ->select('id', 'nombre')
        ->get();

    return view('frm_materias')->with('materias', $materias);
}

public function store(Request $request)
{
    if ($request->id == 0) {
        DB::table('materia')->insert([
            'nombre' => $request->nombre,
        ]);
    } else {
        DB::table('materia')
            ->where('id', $request->id)
            ->update([
                'nombre' => $request->nombre,
            ]);
    }

    $materias = DB::table('materia')->get();
    return redirect()->route('materias')->with('materias', $materias);
}

public function delete(Request $request)
{
    DB::table('materia')->where('id', $request->id)->delete();

    $materias = DB::table('materia')->get();
    return redirect()->route('materias')->with('materias', $materias);
}


}
