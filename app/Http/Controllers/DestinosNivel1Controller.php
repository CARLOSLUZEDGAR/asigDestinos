<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DestinosNivel1Controller extends Controller
{
    public function selectDestinosNivel1(Request $request){
        // if(!$request->ajax()) return view('/');
         $destinos_nivel1 = DB::table('destinos_nivel1')
         ->where('destn1_estado','=','1')
         ->select('id','destn1_descripcion')->orderBy('destn1_descripcion','asc')->get();
         return['destinos_nivel1' => $destinos_nivel1];
     }
}
