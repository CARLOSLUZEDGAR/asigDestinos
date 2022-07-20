<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DestinosNivel2Controller extends Controller
{
    public function selectDestinosNivel2(Request $request){
        // if(!$request->ajax()) return view('/');
         $destinos_nivel2 = DB::table('destinos_nivel2')
         ->where('destn2_estado','=','1')
         ->select('id','destn2_descripcion')->orderBy('destn2_descripcion','asc')->get();
         return['destinos_nivel2' => $destinos_nivel2];
    }

    public function selectbuscarDestinosNivel2(Request $request){

        $buscar = $request->buscar;
        
        // if (!$request->ajax()) return redirect('/');
        $destinos_nivel2 = DB::table('destinos_nivel2')
        ->where('destn2_destn1codigo','=',$buscar)
        ->where('destn2_estado','=','1')
        ->select('id','destn2_descripcion')->orderBy('destn2_descripcion', 'asc')->get();
        return ['destinos_nivel2' => $destinos_nivel2];
    }
}
