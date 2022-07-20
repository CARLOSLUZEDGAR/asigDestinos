<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalDatosController extends Controller
{
    public function index(Request $request)
    {
       // if(!$request->ajax()) return redirect('/');//si la peticion no es tipo ajax que nos rerotne a la pagina prncipal
        //$usuarios = Usuario::all(); //con esta sentencia obtenemos todos los valores de la tabla usuario
        //return $usuarios; //con esto retornamos los valores

        $per_codigo = $request->per_codigo;
        
        /*$personal_datos = DB::table('personal')
                            ->where('per_codigo',$per_codigo)
                            ->first();*/
        $personal_datos = DB::table('personal')
        ->join('escalafon_personal','personal.per_codigo','escalafon_personal.per_codigo')
        ->join('escalafones','escalafones.esca_codigo','escalafon_personal.esca_codigo')
        ->join('subescalafones','subescalafones.id','escalafon_personal.subesc_codigo')
        ->join('grados','grados.id','escalafon_personal.gra_codigo')
        ->join('estudio_personal','estudio_personal.per_codigo','personal.per_codigo')
        ->join('estudio','estudio.id','estudio_personal.est_codigo')
        ->select('personal.per_codigo',
                'personal.per_paterno',
                'personal.per_materno',
                'personal.per_nombre',
                'personal.per_sexo',
                'personal.per_ci',
                'personal.per_cm',
                'grados.gra_abreviatura',
                'estudio.estu_abreviatura',
                'subescalafones.id as subescid',
                'subescalafones.subesc_nombre',
                'escalafon_personal.estado as escperestado',
                'estudio_personal.id as estperestado')
        ->where('personal.per_codigo',$per_codigo)
        ->where('escalafon_personal.estado',1)
        ->where('estudio_personal.est_flag',1)
       // ->orderBy('personal.per_codigo','desc')
        ->first();
        return response()->json($personal_datos);

    }
}
