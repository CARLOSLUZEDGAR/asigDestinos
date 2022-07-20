<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NivelController extends Controller
{
    public function selectNivel(Request $request){
        // if(!$request->ajax()) return view('/');
        $nivel = DB::table('niveles')
        ->select('id','nivel_abreviatura')
        ->where('nivel_estado',1)
        ->orderBy('id','asc')
        ->get();
        return response()->json($nivel);
    }

    public function selectBuscarNivel(Request $request)
    {
        $col_id = $request->col_id;

        $nivel = DB::table('estudiante_cursos')
        ->join('niveles','niveles.id','estudiante_cursos.cod_nivel')
        ->select('cod_nivel',
                'niveles.nivel_abreviatura',
                'niveles.nivel_nombre')
        ->where('cod_col',$col_id)
        ->where('estc_estado',1)
        ->groupBy('cod_nivel')
        ->groupBy('niveles.nivel_abreviatura')
        ->groupBy('niveles.nivel_nombre')
        ->orderBy('cod_nivel','asc')
        ->get();
        return response()->json($nivel);
    }
}
