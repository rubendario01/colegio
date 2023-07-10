<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HorarioController extends Controller
{
    //
    public function index()
{
    $horarios = DB::table('horario')
        ->select('id', 'dia', 'hora_inicio', 'hora_fin')
        ->get();

    return view('frm_horarios')->with('horarios', $horarios);
}

public function store(Request $request)
{
    if ($request->id == 0) {
        DB::table('horario')->insert([
            'dia' => $request->dia,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
        ]);
    } else {
        DB::table('horario')
            ->where('id', $request->id)
            ->update([
                'dia' => $request->dia,
                'hora_inicio' => $request->hora_inicio,
                'hora_fin' => $request->hora_fin,
            ]);
    }

    $horarios = DB::table('horario')->get();
    return redirect()->route('horarios')->with('horarios', $horarios);
}

public function delete(Request $request)
{
    DB::table('horario')->where('id', $request->id)->delete();

    $horarios = DB::table('horario')->get();
    return redirect()->route('horarios')->with('horarios', $horarios);
}

}
