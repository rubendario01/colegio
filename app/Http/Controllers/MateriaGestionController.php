<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MateriaGestionController extends Controller
{
    //
    public function index(){
        $cursogestiones = DB::table('materiagestion')
        ->join('cursogestion',function($join){
            $join->on('materiagestion.id_curso', '=', 'cursogestion.id_curso')
                 ->on('materiagestion.id_gestion', '=', 'cursogestion.id_gestion');
        })

        ->join('materia', 'materiagestion.id_materia', '=', 'materia.id')
        ->join('gestion', 'cursogestion.id_gestion', '=', 'gestion.id')
        ->join('curso', 'cursogestion.id_curso', '=', 'curso.id')
        ->select('curso.grado', 'curso.nivel', 'curso.turno', 'gestion.anio',  'materia.id as id_materia',  'curso.id as id_curso',  'gestion.id as id_gestion')
        ->groupBy('curso.grado', 'curso.nivel', 'curso.turno', 'gestion.anio', 'materia.id', 'curso.id', 'gestion.id')
        ->distinct()
        ->get();

        $cursosxgestiones = DB::table('cursogestion')
        ->leftJoin('materiagestion',function($join){
            $join->on('materiagestion.id_curso', '=', 'cursogestion.id_curso')
                 ->on('materiagestion.id_gestion', '=', 'cursogestion.id_gestion');
                 
        })
        
        ->join('gestion', 'cursogestion.id_gestion', '=', 'gestion.id')
        ->join('curso', 'cursogestion.id_curso', '=', 'curso.id')
        ->whereNull('materiagestion.id_curso')
        ->whereNull('materiagestion.id_gestion')
        ->where('cursogestion.estado', 0)
        ->select('curso.grado', 'curso.nivel', 'curso.turno', 'gestion.anio', 'cursogestion.id_curso', 'cursogestion.id_gestion')
        ->orderBy('anio', 'desc')

        ->get()
        ;

        $aniosgestiones = DB::table('cursogestion')
        ->leftJoin('materiagestion',function($join){
            $join->on('materiagestion.id_curso', '=', 'cursogestion.id_curso')
                 ->on('materiagestion.id_gestion', '=', 'cursogestion.id_gestion');
                 
        })
        
        ->join('gestion', 'cursogestion.id_gestion', '=', 'gestion.id')
        ->join('curso', 'cursogestion.id_curso', '=', 'curso.id')
        ->whereNull('materiagestion.id_curso')
        ->whereNull('materiagestion.id_gestion')
        ->select('gestion.anio', 'cursogestion.id_curso', 'cursogestion.id_gestion')
        
        ->get();

        $materias = DB::table('materia')
        ->select('id', 'nombre')
        ->get();

        return view('frm_materiagestion')->with(['cursogestiones'=>$cursogestiones->groupBy('grado')->map->first(), 'materias'=>$materias
        , 'cursoxgestiones'=>$cursosxgestiones, 'aniosgestiones'=>$aniosgestiones->groupBy('anio')->map->first()]);

    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
            $id_gestion = $request->id_gestion;
            $id_curso = $request->id_curso;
            $materias = $request->materias;
            foreach($materias as $materia){
                DB::table('materiagestion')->insert([
                    'id_curso'=>$id_curso,
                    'id_gestion'=>$id_gestion,
                    'id_materia'=>$materia['id'],
                ]);
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }


    }

    public function verDetalle(Request $request){
        $materias_seleccionadas = DB::table('materiagestion')
        ->join('cursogestion',function($join){
            $join->on('materiagestion.id_curso', '=', 'cursogestion.id_curso')
                 ->on('materiagestion.id_gestion', '=', 'cursogestion.id_gestion');
        })

        ->join('materia', 'materiagestion.id_materia', '=', 'materia.id')
        ->join('gestion', 'cursogestion.id_gestion', '=', 'gestion.id')
        ->join('curso', 'cursogestion.id_curso', '=', 'curso.id')
        ->select('curso.grado', 'curso.nivel', 'curso.turno', 'gestion.anio',  'materia.id as id_materia',  'curso.id as id_curso',  'gestion.id as id_gestion', 'materia.id', 'materia.nombre')
        ->groupBy('curso.grado', 'curso.nivel', 'curso.turno', 'gestion.anio', 'materia.id', 'curso.id', 'gestion.id', 'materia.id', 'materia.nombre')
        ->where('curso.id', $request->id_curso)
        ->where('gestion.id', $request->id_gestion)
        ->get();

        return $materias_seleccionadas;
    }

    public function modificarMateriaGestion(Request $request){
        try{
            DB::beginTransaction();
             // eliminando todo
            DB::table('materiagestion')
            ->where('id_gestion', $request->id_gestion)
            ->where('id_curso', $request->id_curso)
            ->delete();
    
            foreach ($request->materias as $dato) {
                DB::table('materiagestion')->insert([
                    'id_materia'=>$dato['id_materia'],
                    'id_gestion'=>$request->id_gestion,
                    'id_curso'=>$request->id_curso,
                ]);
            }
 
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function verCursosGestion(Request $request){
        $cursosxgestiones = DB::table('cursogestion')
        ->leftJoin('materiagestion',function($join){
            $join->on('materiagestion.id_curso', '=', 'cursogestion.id_curso')
                 ->on('materiagestion.id_gestion', '=', 'cursogestion.id_gestion');
                 
        })
        
        ->join('gestion', 'cursogestion.id_gestion', '=', 'gestion.id')
        ->join('curso', 'cursogestion.id_curso', '=', 'curso.id')
        ->whereNull('materiagestion.id_curso')
        ->whereNull('materiagestion.id_gestion')
        ->select('curso.grado', 'curso.nivel', 'curso.turno', 'gestion.anio', 'cursogestion.id_curso', 'cursogestion.id_gestion')
        ->where('cursogestion.id_gestion', $request->id_gestion)
        ->get();
        return $cursosxgestiones;
    }

}
