<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DestinosNivel3Controller extends Controller
{
    public function selectDestinosNivel3(Request $request){
        // if(!$request->ajax()) return view('/');
         $destinos_nivel3 = DB::table('destinos_nivel3')
         ->where('destn3_estado','=','1')
         ->select('id','destn3_descripcion')->orderBy('destn3_descripcion','asc')->get();
         return['destinos_nivel3' => $destinos_nivel3];
    }


     public function selectbuscarDestinosNivel3(Request $request){

        $buscar = $request->buscar;
        

        // if (!$request->ajax()) return redirect('/');
        $destinos_nivel3 = DB::table('destinos_nivel3')       
        ->where('destn3_destn2codigo','=',$buscar)
        ->where('destn3_estado','=','1')
        ->select('id','destn3_descripcion')->orderBy('destn3_descripcion', 'asc')->get();
        return ['destinos_nivel3' => $destinos_nivel3];
    }
}
