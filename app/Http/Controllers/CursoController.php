<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CursoController extends Controller
{
    public function selectCurso(Request $request){
        // if(!$request->ajax()) return view('/');
        $curso = DB::table('cursos')
        ->select('id','curso_sigla')
        ->where('curso_estado',1)
        ->orderBy('id','asc')
        ->get();
        return response()->json($curso);
    }

    public function selectBuscarCurso(Request $request)
    {
        $cod_col = $request->col_id;
        $nivel_cod = $request->nivel_cod;
        $curso = DB::table('estudiante_cursos')
                    ->join('cursos','cursos.id','estudiante_cursos.cod_curso')
                    ->select('cod_col',
                            'cod_nivel',
                            'cod_curso',
                            'cursos.curso_sigla')
                    ->where('cod_col',$cod_col)
                    ->where('cod_nivel',$nivel_cod)
                    ->where('estudiante_cursos.estc_estado',1)
                    ->groupBy('cod_col')
                    ->groupBy('cod_nivel')
                    ->groupBy('cod_curso')
                    ->groupBy('cursos.curso_sigla')
                    ->orderBy('cod_curso','asc')
                    ->get();
        return response()->json($curso);
    }

    public function selectBuscarParalelo(Request $request)
    {
        $cod_col = $request->col_id;
        $nivel = $request->nivel_cod;
        $curso = $request->curso_cod;
        $paralelo = DB::table('estudiante_cursos')
                    ->select('cod_col',
                            'cod_nivel',
                            'cod_curso',
                            'paralelo')
                    ->where('cod_col',$cod_col)
                    ->where('cod_nivel',$nivel)
                    ->where('cod_curso',$curso)
                    ->where('estudiante_cursos.estc_estado',1)
                    ->groupBy('cod_col')
                    ->groupBy('cod_nivel')
                    ->groupBy('cod_curso')
                    ->groupBy('paralelo')
                    ->orderBy('paralelo','asc')
                    ->get();
        return response()->json($paralelo);
    }


    public function cursosColegio(Request $request){
        // if(!$request->ajax()) return view('/');
        $colegio = $request->col_id;

        $curso_colegios = DB::table('estudiante_cursos as ec')
                        ->join('niveles as n','n.id','ec.cod_nivel')
                        ->join('cursos as c','c.id','ec.cod_curso')
                        ->select('ec.cod_col',
                                'n.nivel_abreviatura',
                                'c.curso_sigla',
                                'paralelo',
                                DB::raw('count(paralelo) as cantestcur'))
                        ->where('estc_estado',1)
                        ->where('cod_col',$colegio)
                        ->groupBy('ec.cod_col')
                        ->groupBy('n.nivel_abreviatura')
                        ->groupBy('c.curso_sigla')
                        ->groupBy('paralelo')
                        ->orderBy('n.nivel_abreviatura','asc')
                        ->orderBy('c.curso_sigla','asc')
                        ->orderBy('paralelo','asc')
                        ->get();
        return response()->json($curso_colegios);
    }
}
