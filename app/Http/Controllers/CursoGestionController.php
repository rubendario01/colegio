<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CursoGestionController extends Controller
{
    //
    public function index(){
        // $cursogestiones = DB::table('cursogestion')
        // ->join('curso', 'curso.id', '=', 'cursogestion.id_curso')
        // ->join('gestion', 'gestion.id', '=', 'cursogestion.id_gestion')
        // ->select('curso.grado', 'curso.nivel', 'curso.turno', 'curso.cupo', 'gestion.anio', 'gestion.fecha_inicio', 
        // 'gestion.fecha_fin', 'cursogestion.id_curso', 'cursogestion.id_gestion')
        // ->get();

        // return view('frm_cursogestion')->with(['cursogestiones'=>$cursogestiones]);
        $cursos = DB::table('curso')->get();
        $gestiones = DB::table('gestion')
        ->join('cursogestion', 'gestion.id', '=', 'cursogestion.id_gestion')
        ->join('curso', 'curso.id', '=', 'cursogestion.id_curso')
        ->select('gestion.id', 'anio', 'fecha_inicio', 'fecha_fin', 'cursogestion.estado')
        ->groupBy('gestion.id', 'anio', 'fecha_inicio', 'fecha_fin', 'cursogestion.estado')
        ->orderBy('anio', 'desc')
        ->distinct()
        ->get();

        return view('frm_cursogestion')->with(['cursogestiones'=> $gestiones, 'cursos'=>$cursos]);
    }

    public function frmGuardar(Request $request){
        $cursos = DB::table('curso')->get();
        // $gestiones = DB::table('gestion')
        // ->join('cursogestion', 'cursogestion.id_gestion', 'gestion.id')
        // ->get();
        $gestiones = DB::table('gestion')
        ->leftJoin('cursogestion', 'cursogestion.id_gestion', 'gestion.id')
        ->whereNull('cursogestion.id_gestion')
        ->get();
        return view('frm_guardar_cursogestion')->with(['cursos'=>$cursos, 'gestiones'=>$gestiones]);
    }
    public function store(Request $request){
        if(DB::table('cursogestion')->where('id_curso', $request->id_curso)->where('id_gestion', $request->id_gestion)->count()<=0){
            //dd($request->cursos);
            try{
                DB::beginTransaction();

                foreach ($request->cursos as $dato) {
                    DB::table('cursogestion')->insert([
                        'id_curso'=>$dato['id'],
                        'id_gestion'=>$request->id_gestion,
                    ]);
                }
        
                $cursogestiones = DB::table('cursogestion')
                ->join('curso', 'curso.id', '=', 'cursogestion.id_curso')
                ->join('gestion', 'gestion.id', '=', 'cursogestion.id_gestion')
                ->select('curso.grado', 'curso.nivel', 'curso.turno', 'curso.cupo', 'gestion.anio', 'gestion.fecha_inicio', 
                'gestion.fecha_fin', 'cursogestion.id_curso', 'cursogestion.id_gestion')
                ->get();
        
                DB::commit();
                // return redirect()->route('cursogestion')->with(['cursogestiones'=>$cursogestiones, 
                // 'mensaje'=>'Registro exitoso..!!!']);
                return ['cursogestiones'=>$cursogestiones, 'mensaje'=>'Registro exitoso..!!!'];
            }catch(Exception $e){
                DB::rollback();
            }
        }else{
            return ['error'=>1];
        }

    }

    public function verCursos(Request $request){
        $registros = DB::table('cursogestion')
        ->join('curso', 'curso.id', '=', 'cursogestion.id_curso')
        ->join('gestion', 'gestion.id', '=', 'cursogestion.id_gestion')
        ->select('curso.grado', 'curso.nivel', 'curso.turno', 'curso.cupo', 'gestion.anio', 'gestion.fecha_inicio', 
        'gestion.fecha_fin', 'cursogestion.id_curso', 'cursogestion.id_gestion', 'cursogestion.estado')
        ->where('gestion.id', $request->id_gestion)
        ->get();

        return $registros;
    }

    public function activar(Request $request){
     
            $cursogestion = DB::table('cursogestion')
            ->where('id_curso', $request->id_curso)
            ->where('id_gestion', $request->id_gestion)
            ->update([
                'estado'=>0
            ]);
        
        return ['id_gestion'=>$request->id_gestion];
     
    }
    public function desactivar(Request $request){
        $cursogestion = DB::table('cursogestion')
        ->where('id_curso', $request->id_curso)
        ->where('id_gestion', $request->id_gestion)
        ->update([
            'estado'=>1
        ]);
        return ['id_gestion'=>$request->id_gestion];
     
    }

    public function editarCursos(Request $request){
       
        try{
            DB::beginTransaction();
          
            foreach ($request->cursos as $dato) {
                if($dato['estado']==2){
                    DB::table('cursogestion')->insert([
                        'id_curso'=>$dato['id_curso'],
                        'id_gestion'=>$request->id_gestion,
                    ]);
                }
            }
 
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }
}
