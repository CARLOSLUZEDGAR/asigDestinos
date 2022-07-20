<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalController extends Controller
{
    public function index(Request $request){
        if(!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;

        if($buscar == ''){
            $personal = DB::table('personals')
                ->leftjoin('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
                ->leftjoin('escalafones','escalafones.id','personal_escalafones.esca_cod')
                ->leftjoin('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
                ->leftjoin('grados','grados.id','personal_escalafones.gra_cod')
                ->leftjoin('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
                ->leftjoin('estudios','estudios.id','personal_estudios.est_cod')
                ->select('personals.per_codigo',
                        DB::raw("CONCAT(personals.per_paterno,' ',personals.per_materno,' ',personals.per_nombre) as completo"),
                        'personals.per_sexo',
                        'personals.per_ci',
                        'personals.per_cm',
                        'personal_escalafones.gra_cod',
                        'grados.abreviatura as gra_abreviatura',
                        'estudios.abreviatura as estu_abreviatura',
                        'personal_escalafones.estado as escperestado',
                        'personal_estudios.id as estperestado')
                ->where('personal_escalafones.estado',1)
                ->where('personal_estudios.estado',1)
                ->orderBy('grados.id','asc')
                ->take(1)
                ->paginate(10);
        }else{
            $personal = DB::table('personals')
                ->leftjoin('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
                ->leftjoin('escalafones','escalafones.id','personal_escalafones.esca_cod')
                ->leftjoin('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
                ->leftjoin('grados','grados.id','personal_escalafones.gra_cod')
                ->leftjoin('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
                ->leftjoin('estudios','estudios.id','personal_estudios.est_cod')
                ->select('personals.per_codigo',
                        DB::raw("CONCAT(personals.per_paterno,' ',personals.per_materno,' ',personals.per_nombre) as completo"),
                        'personals.per_sexo',
                        'personals.per_ci',
                        'personals.per_cm',
                        'personal_escalafones.gra_cod',
                        'grados.abreviatura as gra_abreviatura',
                        'estudios.abreviatura as estu_abreviatura',
                        'personal_escalafones.estado as escperestado',
                        'personal_estudios.id as estperestado')
                ->where('personal_escalafones.estado',1)
                ->where('personal_estudios.estado',1)
                ->where(function ( $query ) use ($buscar) {
                    $query->orWhere('per_cm','like',$buscar.'%')
                            ->orWhere('per_ci','like',$buscar.'%')
                            ->orWhere( DB::raw("CONCAT(per_paterno,' ',per_materno,' ',per_nombre)"),'like',$buscar.'%');
                })
                ->orderBy('grados.id','asc')
                ->take(1)
                ->paginate(10);
        }

        return [
            'pagination' => [
                'total'         => $personal->total(),
                'current_page'  => $personal->currentPage(),
                'per_page'      => $personal->perPage(),
                'last_page'     => $personal->lastPage(),
                'from'          => $personal->firstItem(),
                'to'            => $personal->lastItem(),

            ],
            'personal' => $personal
        ];
        // return response()->json($personal);
    }

    public function  DatosPersonal(Request $request){
        $per_codigo = $request->per_codigo;
        $personal_datos = DB::table('personals')
        ->leftjoin('personal_escalafones','personals.per_codigo','personal_escalafones.per_codigo')
        ->leftjoin('escalafones','escalafones.id','personal_escalafones.esca_cod')
        ->leftjoin('subescalafones','subescalafones.id','personal_escalafones.subesc_cod')
        ->leftjoin('grados','grados.id','personal_escalafones.gra_cod')
        ->leftjoin('personal_estudios','personal_estudios.per_codigo','personals.per_codigo')
        ->leftjoin('estudios','estudios.id','personal_estudios.est_cod')
        ->select('personals.per_codigo',
                'personals.per_paterno',
                'personals.per_materno',
                'personals.per_nombre',
                'personals.per_sexo',
                'personals.per_ci',
                'personals.per_expedido',
                'personals.per_cm',
                'personals.per_promo',
                'personals.per_foto',
                'grados.id as idgrado',
                'personal_escalafones.gra_cod',
                'grados.abreviatura as gra_abreviatura',
                'estudios.abreviatura as estu_abreviatura',
                'subescalafones.id as subescid',
                'subescalafones.nombre',
                'personal_escalafones.estado as escperestado',
                'personal_estudios.estado as estperestado',
                'escalafones.nombre as esca_nombre',
                'subescalafones.nombre as subesca_nombre',
                'grados.nombre as gra_nombre')
        ->where('personals.per_codigo',$per_codigo)
        ->where('personal_escalafones.estado',1)
        ->where('personal_estudios.estado',1)
       
       // ->orderBy('personals.per_codigo','desc')
        ->first();
       // return response()->json($personal_datos);
        return response()->json(['personal_datos' => $personal_datos]);
    }
}