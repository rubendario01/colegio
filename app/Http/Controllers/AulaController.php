<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AulaController extends Controller
{
    //
    public function index(){
        return view('frm_aula');
    }

    public function getGestiones(){
        $gestiones = DB::table('materiagestion')
        ->select('gestion.anio', 'gestion.id as id_gestion')
        ->join('materia', 'materia.id', '=', 'materiagestion.id_materia')
        
        ->join('cursogestion',function($join){
            $join->on('materiagestion.id_curso', '=', 'cursogestion.id_curso')
                 ->on('materiagestion.id_gestion', '=', 'cursogestion.id_gestion');
        })
        ->join('gestion', 'cursogestion.id_gestion', '=', 'gestion.id')
        ->join('curso', 'cursogestion.id_curso', '=', 'curso.id')
        //->where('cursogestion.estado', 0)
        ->distinct('gestion.anio')
        ->get();

        return $gestiones;

    }
}
