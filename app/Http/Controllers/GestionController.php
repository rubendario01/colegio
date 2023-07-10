<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GestionController extends Controller
{
    //
    public function index()
{
    $gestiones = DB::table('gestion')
        ->select('id', 'anio', 'fecha_inicio', 'fecha_fin')
        ->get();

    return view('frm_gestiones')->with('gestiones', $gestiones);
}

public function store(Request $request)
{
    if ($request->id == 0) {
        DB::table('gestion')->insert([
            'anio' => $request->anio,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);
    } else {
        DB::table('gestion')
            ->where('id', $request->id)
            ->update([
                'anio' => $request->anio,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
            ]);
    }

    $gestiones = DB::table('gestion')->get();
    return redirect()->route('gestiones')->with('gestiones', $gestiones);
}

public function delete(Request $request)
{
    DB::table('gestion')->where('id', $request->id)->delete();

    $gestiones = DB::table('gestion')->get();
    return redirect()->route('gestiones')->with('gestiones', $gestiones);
}

}
