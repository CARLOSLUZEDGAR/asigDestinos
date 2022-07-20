<?php

namespace App\Http\Controllers;

use App\EstudianteCursos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class EstudianteCursosController extends Controller
{
    public function index (Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar=='')
        {
            $estudiante = DB::table('estudiantes')
                        ->leftJoin('estudiante_cursos as ec','ec.cod_est','estudiantes.id')
                        ->select(
                            'estudiantes.id',
                            'estudiantes.est_rude',
                            'estudiantes.est_paterno',
                            'estudiantes.est_materno',
                            'estudiantes.est_nombre',
                            'estudiantes.est_ci',
                            'estudiantes.est_expedido',
                            'estudiantes.est_estado',
                            'estudiantes.est_observacion'
                        )
                        ->orderBy('estudiantes.est_paterno','asc')
                        ->take(1)
                        ->paginate(10);
        }
        else
        {
            $estudiante = DB::table('estudiantes')
                        ->select(
                            'estudiantes.id',
                            'estudiantes.est_rude',
                            'estudiantes.est_paterno',
                            'estudiantes.est_materno',
                            'estudiantes.est_nombre',
                            'estudiantes.est_ci',
                            'estudiantes.est_expedido',
                            'estudiantes.est_estado',
                            'estudiantes.est_observacion'
                        )
                        ->where($criterio,'like','%'.$buscar.'%')
                        ->orderBy('estudiantes.est_paterno','asc')
                        ->take(1)
                        ->paginate(10);
        }
        return [
            'pagination' => [
                'total'         => $estudiante->total(),
                'current_page'  => $estudiante->currentPage(),
                'per_page'      => $estudiante->perPage(),
                'last_page'     => $estudiante->lastPage(),
                'from'          => $estudiante->firstItem(),
                'to'            => $estudiante->lastItem(),
            
            ],
            'estudiante' => $estudiante
        ];

        //return response()->json($estudiante);
    }

    public function estudiantesCurso (Request $request)
    {
        $col_id = $request->col_id;
        $nivel = $request->nivel;
        $curso = $request->curso;
        $paralelo = $request->paralelo;

        $estudiantesCurso = DB::table('estudiante_cursos as estcur')
                                ->join('estudiantes as est','estcur.cod_est','est.id')
                                ->select(
                                    'estcur.id',
                                    'est.id',
                                    'est.est_rude',
                                    'est.est_paterno',
                                    'est.est_materno',
                                    'est.est_nombre',
                                    'est.est_ci',
                                    'est.est_expedido'
                                )
                                ->where('cod_col',$col_id)
                                ->where('cod_nivel',$nivel)
                                ->where('cod_curso',$curso)
                                ->where('paralelo',$paralelo)
                                ->where('estc_estado',1)
                                ->orderBy('est.est_paterno','asc')
                                ->take(1)
                                ->paginate(10);
        
        return [
            'pagination' => [
                'total'         => $estudiantesCurso->total(),
                'current_page'  => $estudiantesCurso->currentPage(),
                'per_page'      => $estudiantesCurso->perPage(),
                'last_page'     => $estudiantesCurso->lastPage(),
                'from'          => $estudiantesCurso->firstItem(),
                'to'            => $estudiantesCurso->lastItem(),
            
            ],
            'estudiantesCurso' => $estudiantesCurso
        ];

        //return response()->json($estudiante);
    }

    public function designarEstudiante(Request $request)
    {
       $estudiante = EstudianteCursos::create([
            //'CAMPO DE LA TABLA' => $request->NOMBRE Q VIENE DE LA VISTA
            'cod_est' => $request->cod_est,
            'cod_col' => $request->cod_col,
            'cod_nivel' => $request->cod_nivel,
            'cod_curso' => $request->cod_curso,
            'paralelo' => $request->paralelo,
            'gestion' => '2021',
            'estc_estado' => '1',
            'estc_flag' => '1',
            'estc_observacion' => $request->estc_observacion,
            'estc_sysuser' => 'ADMIN', 
        ]);

        //return response()->json($request);
    }
}
