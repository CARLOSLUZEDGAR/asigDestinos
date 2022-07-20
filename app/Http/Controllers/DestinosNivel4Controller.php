<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DestinosNivel4Controller extends Controller
{
    public function selectDestinosNivel4(Request $request){
        // if(!$request->ajax()) return view('/');
         $destinos_nivel4 = DB::table('destinos_nivel4')
         ->where('destn4_estado','=','1')
         ->select('id','destn4_descripcion')->orderBy('destn4_descripcion','asc')->get();
         return['destinos_nivel4' => $destinos_nivel4];
    }


     public function selectbuscarDestinosNivel4(Request $request){

        $buscar = $request->buscar;
        

        // if (!$request->ajax()) return redirect('/');
        $destinos_nivel4 = DB::table('destinos_nivel4')      
        ->where('destn4_destn3codigo','=',$buscar)
        ->where('destn4_estado','=','1')
        ->select('id','destn4_descripcion')->orderBy('destn4_descripcion', 'asc')->get();
        return ['destinos_nivel4' => $destinos_nivel4];
    }
}
