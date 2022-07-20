<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AreaController extends Controller
{
    public function selectBuscarArea(Request $request)
    {
        // $cod_col = $request->col_id;
        // $nivel = $request->nivel_cod;
        $campo = $request->campo_cod;
        $area = DB::table('areas')
                    ->select('id',
                            'cam_cod',
                            'area_nombre')
                    ->where('cam_cod',$campo)
                    ->orderBy('id','asc')
                    ->get();
        return response()->json($area);
    }
}
