<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalController extends Controller
{
    /*public function ListarPersonal()
    {
        $personal = DB::table('personal')
            ->limit(10)
            ->get();
        return response()->json($personal);
    }*/

    public function index(Request $request)
    {
       // if(!$request->ajax()) return redirect('/');//si la peticion no es tipo ajax que nos rerotne a la pagina prncipal
        //$usuarios = Usuario::all(); //con esta sentencia obtenemos todos los valores de la tabla usuario
        //return $usuarios; //con esto retornamos los valores

        $buscar = $request->buscar;
        $criterio = $request->criterio;


       /* if($buscar==''){
            $personal = DB::table('personal')
            ->orderBy('personal.id','desc')
            ->paginate(10);
            return response()->json($personal);
        }
        if($criterio == 'per_cm'){
                $personal = DB::table('personal')
                ->where('personal.per_cm','=', $buscar)
                ->orderBy('personal.per_codigo','desc')
                ->take(1)
                ->paginate(10);
                return response()->json($personal);
        }
        elseif($criterio == 'per_paterno'){
                $personal = DB::table('personal')
                ->where('personal.per_paterno','=', $buscar)
                ->orderBy('personal.per_codigo','desc')
                ->take(1)
                ->paginate(10);
                return response()->json($personal);
            }
            elseif($criterio == 'per_ci'){
                $personal = DB::table('personal')
                ->where('personal.per_ci','=', $buscar)
                ->orderBy('personal.per_codigo','desc')
                ->take(1)
                ->paginate(10);
                return response()->json($personal);
            }*/
            //return response()->json($personal);
        if($buscar==''){
            $personal = DB::table('personal')
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
                    'escalafon_personal.estado as escperestado',
                    'estudio_personal.id as estperestado')
            ->where('escalafon_personal.estado',1)
            ->where('estudio_personal.est_flag',1)
            ->orderBy('personal.per_cm','asc')
            ->take(1)
            ->paginate(10);
                
        }else{
            $personal = DB::table('personal')
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
                    'escalafon_personal.estado as escperestado',
                    'estudio_personal.id as estperestado')
            ->where('escalafon_personal.estado',1)
            ->where('estudio_personal.est_flag',1)
            ->where($criterio,'like','%'.$buscar.'%')
            ->orderBy('personal.per_cm','asc')
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

       return response()->json($request);


    }
}
