<?php

namespace App\Http\Controllers;

use App\EstudianteCursos;
use App\Estudiantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    public function index (Request $request)
    {
        $buscar = $request->buscar;
        // $criterio = $request->criterio;
        $colegio = $request->col_id;

        if($buscar=='')
        {
            $estudiante = DB::table('estudiantes')
                        ->join('estudiante_cursos','estudiantes.id','estudiante_cursos.cod_est')
                        ->join('niveles','estudiante_cursos.cod_nivel','niveles.id')
                        ->join('cursos','estudiante_cursos.cod_curso','cursos.id')
                        ->select(
                            'estudiantes.id',
                            'estudiantes.est_rude',
                            'estudiantes.est_paterno',
                            'estudiantes.est_materno',
                            'estudiantes.est_nombre',
                            'estudiantes.est_ci',
                            'estudiantes.est_expedido',
                            'estudiantes.est_estado',
                            'estudiantes.est_observacion',
                            'estudiante_cursos.id as estcurid',
                            'estudiante_cursos.cod_nivel',
                            'estudiante_cursos.cod_curso',
                            'estudiante_cursos.paralelo',
                            'estudiante_cursos.gestion',
                            'niveles.nivel_abreviatura',
                            'cursos.curso_sigla',
                        )
                        ->where('estudiante_cursos.cod_col',$colegio)
                        ->where('estudiante_cursos.estc_estado',1)
                        ->orderBy('estudiantes.est_paterno','asc')
                        ->take(1)
                        ->paginate(10);
        }
        else
        {
            $estudiante = DB::table('estudiantes')
                        ->join('estudiante_cursos','estudiantes.id','estudiante_cursos.cod_est')
                        ->join('niveles','estudiante_cursos.cod_nivel','niveles.id')
                        ->join('cursos','estudiante_cursos.cod_curso','cursos.id')
                        ->select(
                            'estudiantes.id',
                            'estudiantes.est_rude',
                            'estudiantes.est_paterno',
                            'estudiantes.est_materno',
                            'estudiantes.est_nombre',
                            'estudiantes.est_ci',
                            'estudiantes.est_expedido',
                            'estudiantes.est_estado',
                            'estudiantes.est_observacion',
                            'estudiante_cursos.id as estcurid',
                            'estudiante_cursos.cod_nivel',
                            'estudiante_cursos.cod_curso',
                            'estudiante_cursos.paralelo',
                            'estudiante_cursos.gestion',
                            'niveles.nivel_abreviatura',
                            'cursos.curso_sigla',
                        )
                        ->where('estudiante_cursos.cod_col',$colegio)
                        ->where('estudiante_cursos.estc_estado',1)
                        ->where(function ( $query ) use ($buscar) {
                            $query->orWhere('est_rude','like','%'.$buscar.'%')
                                    ->orWhere('est_paterno','like','%'.$buscar.'%')
                                    ->orWhere('est_materno','like','%'.$buscar.'%')
                                    ->orWhere('est_nombre','like','%'.$buscar.'%')
                                    ->orWhere('est_ci','like','%'.$buscar.'%');
                        })
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

    public function registrarEstudiante(Request $request)
    {
        $estudiante = Estudiantes::create([
            //'CAMPO DE LA TABLA' => $request->NOMBRE Q VIENE DE LA VISTA
            'est_rude' => $request->est_rude,
            'est_paterno' => $request->est_paterno,
            'est_materno' => $request->est_materno,
            'est_nombre' => $request->est_nombre,
            'est_ci' => $request->est_ci,
            'est_expedido' => $request->est_expedido,
            'est_estado' => '1',
            'est_observacion' => $request->est_observacion,
            'est_sysuser' => 'ADMIN',   
        ]);
        $estudiante_curso = EstudianteCursos::create([
            'cod_est' => $estudiante->id,
            // 'cod_col' => $request->desig_col,
            'cod_col' => $request->cod_col,
            'cod_nivel' => $request->cod_nivel,
            'cod_curso' => $request->cod_curso,
            'paralelo' => $request->paralelo,
            'gestion' => $request->gestion,
            'estc_estado' => 1,
            'estc_flag' => 1,
            'estc_observacion' => $request->est_observacion,
            'estc_sysuser' => 'ADMIN',
        ]);
    }

    public function updateEstudiante(Request $request)
    {
        $estudiante = Estudiantes::where('id',$request->est_id)
                    ->first();
        $estudiante -> update([
            'est_rude' => $request->est_rude,
            'est_paterno' => $request->est_paterno,
            'est_materno' => $request->est_materno,
            'est_nombre' => $request->est_nombre,
            'est_ci' => $request->est_ci,
            'est_expedido' => $request->est_expedido,
            'est_observacion' => $request->est_observacion,
        ]);
        $estudiante_curso = EstudianteCursos::where('id',$request->estcur_id)
                            ->first();
        $estudiante_curso -> update([
            'cod_nivel' => $request->cod_nivel,
            'cod_curso' => $request->cod_curso,
            'paralelo' => $request->paralelo,
            'gestion' => $request->gestion,
            'estc_observacion' => $request->est_observacion,
        ]);
    }
}
