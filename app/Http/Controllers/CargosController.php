<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CargosController extends Controller
{
    public function ListarCargos(Request $request)
    {
        $filtro = $request->filtro;

        if ($filtro==1 || $filtro==2 || $filtro==3)
            {
                $asignacion='O';
                $cargos = DB::table('cargo')
                ->select('id','desc_cargo as descripcion')
                ->where('asignacion','like', '%' . $asignacion .  '%')
                ->where('estado',1)
                ->orderBy('desc_cargo','asc')
                ->get();
                return response()->json($cargos);
            }
            else if ($filtro==4 || $filtro==5 || $filtro==6)
            {
                $asignacion='S';
                $cargos = DB::table('cargo')
                ->select('id','desc_cargo as descripcion')
                ->where('asignacion','like', '%' . $asignacion .  '%')
                ->where('estado',1)
                ->orderBy('desc_cargo','asc')
                ->get();
                return response()->json($cargos);
            }
            else if ($filtro==21)
            {
                $asignacion='M';
                $cargos = DB::table('cargo')
                ->select('id','desc_cargo as descripcion')
                ->where('asignacion','like', '%' . $asignacion .  '%')
                ->where('estado',1)
                ->orderBy('desc_cargo','asc')
                ->get();
                return response()->json($cargos);
            }
            else if ($filtro==7 || $filtro==8 || $filtro==9 || $filtro==10 || $filtro==11 || $filtro==12)
            {
                $asignacion='C';
                $cargos = DB::table('cargo')
                ->select('id','desc_cargo as descripcion')
                ->where('asignacion','like', '%' . $asignacion .  '%')
                ->where('estado',1)
                ->orderBy('desc_cargo','asc')
                ->get();
                return response()->json($cargos);
            }

        else{

        }
        
        

        /*$cargos = DB::table('cargo')
        ->select('id','desc_cargo as descripcion')
        ->where('asignacion','like', '%' . $asignacion .  '%')
        ->where('estado',1)
        ->orderBy('desc_cargo','asc')
        ->get();
        return response()->json($cargos);*/

        //return response()->json($cargos);
    }
}
