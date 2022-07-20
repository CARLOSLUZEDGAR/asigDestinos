<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CampoController extends Controller
{
    public function selectBuscarCampo(Request $request)
    {
        // $cod_col = $request->col_id;
        $nivel_cod = $request->nivel_cod;
        $campo = DB::table('campos')
                    // ->join('cursos','cursos.id','estudiante_cursos.cod_curso')
                    ->select('id',
                            'campo_nombre')
                    ->where('niv_cod',$nivel_cod)
                    ->orderBy('id','asc')
                    ->get();
        return response()->json($campo);
    }
}
