<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class InscripcionController extends Controller
{
    //
    public function index(Request $request){
        $alumnos_inscritos=DB::table('inscripcion')
        ->join('cursogestion',function($join){
            $join->on('inscripcion.id_curso', '=', 'cursogestion.id_curso')
                 ->on('inscripcion.id_gestion', '=', 'cursogestion.id_gestion');
        })
        ->join('alumno', 'alumno.id', '=', 'inscripcion.id_alumno')
        ->join('gestion', 'gestion.id', '=', 'cursogestion.id_gestion')
        ->join('curso', 'curso.id', '=', 'cursogestion.id_curso')
        ->select('alumno.ci_alumno', 'alumno.id', 'alumno.rude', 'alumno.nombre', 'alumno.apellidos'
        , 'curso.grado', 'curso.turno', 'inscripcion.id as id_inscripcion', 'inscripcion.id_alumno', 'inscripcion.id_curso',
        'inscripcion.id_gestion', 'gestion.anio')
        ->get();

        $alumnos = DB::table('alumno')
            ->select('id', 'ci_alumno', 'nombre', 'apellidos', 'rude', 'fecha_nac', 'sexo', 'direccion')
            ->get();

    
        $cursogestiones = DB::table('materiagestion')
        ->join('cursogestion',function($join){
            $join->on('materiagestion.id_curso', '=', 'cursogestion.id_curso')
                 ->on('materiagestion.id_gestion', '=', 'cursogestion.id_gestion');
        })

        ->join('materia', 'materiagestion.id_materia', '=', 'materia.id')
        ->join('gestion', 'cursogestion.id_gestion', '=', 'gestion.id')
        ->join('curso', 'cursogestion.id_curso', '=', 'curso.id')
        ->select('curso.grado', 'curso.nivel', 'curso.turno', 'gestion.anio', 'curso.id as id_curso',  'gestion.id as id_gestion')
        ->groupBy('curso.grado', 'curso.nivel', 'curso.turno', 'gestion.anio', 'curso.id', 'gestion.id')
        ->distinct()
        ->get();

        

        return view('frm_inscripcion')->with(['alumnos_inscritos'=>$alumnos_inscritos, 'alumnos'=>$alumnos, 'cursogestiones'=>$cursogestiones]);
    }

    public function index2(Request $request){
        // $alumnos_inscritos=DB::table('inscripcion')
        // ->join('cursogestion',function($join){
        //     $join->on('inscripcion.id_curso', '=', 'cursogestion.id_curso')
        //          ->on('inscripcion.id_gestion', '=', 'cursogestion.id_gestion');
        // })
        // ->join('alumno', 'alumno.id', '=', 'inscripcion.id_alumno')
        // ->join('gestion', 'gestion.id', '=', 'cursogestion.id_gestion')
        // ->join('curso', 'curso.id', '=', 'cursogestion.id_curso')
        // ->select('alumno.ci_alumno', 'alumno.id', 'alumno.rude', 'alumno.nombre', 'alumno.apellidos'
        // , 'curso.grado', 'curso.turno', 'inscripcion.id as id_inscripcion', 'inscripcion.id_alumno', 'inscripcion.id_curso',
        // 'inscripcion.id_gestion', 'gestion.anio')
        // ->get();
        // $alumnos = DB::table('alumno')
        //     ->select('id', 'ci_alumno', 'nombre', 'apellidos', 'rude', 'fecha_nac', 'sexo', 'direccion')
        //     ->get();

   

        // $cursogestiones = DB::table('materiagestion')
        // ->join('cursogestion',function($join){
        //     $join->on('materiagestion.id_curso', '=', 'cursogestion.id_curso')
        //          ->on('materiagestion.id_gestion', '=', 'cursogestion.id_gestion');
        // })

        // ->join('materia', 'materiagestion.id_materia', '=', 'materia.id')
        // ->join('gestion', 'cursogestion.id_gestion', '=', 'gestion.id')
        // ->join('curso', 'cursogestion.id_curso', '=', 'curso.id')
        // ->select('curso.grado', 'curso.nivel', 'curso.turno', 'gestion.anio', 'curso.id as id_curso',  'gestion.id as id_gestion')
        // ->groupBy('curso.grado', 'curso.nivel', 'curso.turno', 'gestion.anio', 'curso.id', 'gestion.id')
        // ->distinct()
        // ->get();

        

        // return view('frm_inscripcion')->with(['alumnos_inscritos'=>$alumnos_inscritos, 'alumnos'=>$alumnos, 'cursogestiones'=>$cursogestiones]);
        return view('frm_inscripcion2');

    }
    public function store(Request $request){

        try{
            DB::beginTransaction();
            $fechaActual = Carbon::now()->toDateString();
            DB::table('inscripcion')->insert([
                'id_alumno'=>$request->id_alumno,
                'fecha_inscripcion'=>$fechaActual,
                'id_curso'=>$request->id_curso,
                'id_gestion'=>$request->id_gestion,
            ]);

            DB::commit();

        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function getInscripciones(){
        $alumnos_inscritos=DB::table('inscripcion')
        ->join('cursogestion',function($join){
            $join->on('inscripcion.id_curso', '=', 'cursogestion.id_curso')
                 ->on('inscripcion.id_gestion', '=', 'cursogestion.id_gestion');
        })
        ->join('alumno', 'alumno.id', '=', 'inscripcion.id_alumno')
        ->join('gestion', 'gestion.id', '=', 'cursogestion.id_gestion')
        ->join('curso', 'curso.id', '=', 'cursogestion.id_curso')
        ->select('alumno.ci_alumno', 'alumno.id', 'alumno.rude', 'alumno.nombre', 'alumno.apellidos'
        , 'curso.grado', 'curso.turno', 'inscripcion.id as id_inscripcion', 'inscripcion.id_alumno', 'inscripcion.id_curso',
        'inscripcion.id_gestion', 'gestion.anio', 'inscripcion.estado')
        ->get();

        return $alumnos_inscritos;
    }

    public function getAlumnos(){
        $alumnos = DB::table('alumno')
            ->select('id', 'ci_alumno', 'nombre', 'apellidos', 'rude', 'fecha_nac', 'sexo', 'direccion')
            ->get();

        return $alumnos;
    }

    public function getCursogestiones(){
        $cursogestiones = DB::table('materiagestion')
        ->join('cursogestion',function($join){
            $join->on('materiagestion.id_curso', '=', 'cursogestion.id_curso')
                 ->on('materiagestion.id_gestion', '=', 'cursogestion.id_gestion');
        })

        ->join('materia', 'materiagestion.id_materia', '=', 'materia.id')
        ->join('gestion', 'cursogestion.id_gestion', '=', 'gestion.id')
        ->join('curso', 'cursogestion.id_curso', '=', 'curso.id')
        ->select('curso.grado', 'curso.nivel', 'curso.turno', 'gestion.anio', 'curso.id as id_curso',  'gestion.id as id_gestion')
        ->groupBy('curso.grado', 'curso.nivel', 'curso.turno', 'gestion.anio', 'curso.id', 'gestion.id')
        ->distinct()
        ->get();

        return $cursogestiones;
        
    }

    public function activar(Request $request){
        DB::table('inscripcion')->where('id', $request->id_inscripcion)
        ->update([
            'estado'=>0
        ]);
    }

    public function desactivar(Request $request){
        DB::table('inscripcion')->where('id', $request->id_inscripcion)
        ->update([
            'estado'=>1
        ]);
    }
}
