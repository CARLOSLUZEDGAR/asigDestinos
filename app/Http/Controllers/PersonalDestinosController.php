<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

use App\PersonalDestinos;
use App\PersonalCargo;

class PersonalDestinosController extends Controller
{
    public function index(Request $request)
    {
        $per_codigo = $request->per_codigo;

        if($per_codigo==''){
            $personal_destinos = DB::table("personal_destinos")
            ->orderBy('personal_destinos.id','desc')
            ->paginate(10);     
        }
        else
        {
            $personal_destinos = DB::table("personal_destinos")
            ->join('personal','personal_destinos.perdest_codigocambio','=','personal.per_codigo')
            ->join('destinos_nivel1','personal_destinos.perdest_destn1_codigo','=','destinos_nivel1.id')
            ->join('destinos_nivel2','personal_destinos.perdest_destn2_codigo','=','destinos_nivel2.id')
            ->join('destinos_nivel3','personal_destinos.perdest_destn3_codigo','=','destinos_nivel3.id')
            ->join('destinos_nivel4','personal_destinos.perdest_destn4_codigo','=','destinos_nivel4.id')
            ->join('personal_cargo','personal_destinos.id','=','personal_cargo.cod_dest')
            ->join('cargo','personal_cargo.id_cargo','=','cargo.id')
            ->select('personal_destinos.id as idpersonal_destinos',
                    'destinos_nivel1.destn1_descripcion',
                    'destinos_nivel2.destn2_descripcion',
                    'destinos_nivel3.destn3_descripcion',
                    'destinos_nivel4.destn4_descripcion',
                    'personal.per_nombre',
                    'personal.per_paterno',
                    'personal.per_materno',
                    //'personal_destinos.id',
                    'personal_destinos.perdest_codigocambio',
                    'personal_destinos.perdest_destn1_codigo',
                    'personal_destinos.perdest_destn2_codigo',
                    'personal_destinos.perdest_destn3_codigo',
                    'personal_destinos.perdest_destn4_codigo',
                    'personal_destinos.perdest_tipo_doc',
                    'personal_destinos.perdest_nro_doc',
                    'personal_destinos.perdest_fechadestino',
                    'personal_destinos.promocion',
                    'personal_destinos.perdest_estado',
                    'personal_destinos.perdest_flag',
                    'personal_destinos.perdest_observaciones',
                    'cargo.id as idcargo',
                    'cargo.desc_cargo as cargo'
                    )
            ->where('personal_destinos.perdest_codigocambio', '=', $per_codigo)
            ->where('personal_cargo.nivel_cargo',1)
            ->where('personal_destinos.perdest_flag',1)
            ->orderBy('personal_destinos.perdest_fechadestino','desc')
            ->paginate(50);

            $personal_destinos2 = DB::table("personal_destinos")
            ->join('personal','personal_destinos.perdest_codigocambio','=','personal.per_codigo')
            ->join('destinos_nivel1','personal_destinos.perdest_destn1_codigo','=','destinos_nivel1.id')
            ->join('destinos_nivel2','personal_destinos.perdest_destn2_codigo','=','destinos_nivel2.id')
            ->join('destinos_nivel3','personal_destinos.perdest_destn3_codigo','=','destinos_nivel3.id')
            ->join('destinos_nivel4','personal_destinos.perdest_destn4_codigo','=','destinos_nivel4.id')
            ->join('personal_cargo','personal_destinos.id','=','personal_cargo.cod_dest')
            ->join('cargo','personal_cargo.id_cargo','=','cargo.id')
            ->select('personal_destinos.id as idpersonal_destinos',
                    'destinos_nivel1.destn1_descripcion',
                    'destinos_nivel2.destn2_descripcion',
                    'destinos_nivel3.destn3_descripcion',
                    'destinos_nivel4.destn4_descripcion',
                    'personal.per_nombre',
                    'personal.per_paterno',
                    'personal.per_materno',
                    //'personal_destinos.id',
                    'personal_destinos.perdest_codigocambio',
                    'personal_destinos.perdest_destn1_codigo',
                    'personal_destinos.perdest_destn2_codigo',
                    'personal_destinos.perdest_destn3_codigo',
                    'personal_destinos.perdest_destn4_codigo',
                    'personal_destinos.perdest_tipo_doc',
                    'personal_destinos.perdest_nro_doc',
                    'personal_destinos.perdest_fechadestino',
                    'personal_destinos.promocion',
                    'personal_destinos.perdest_estado',
                    'personal_destinos.perdest_flag',
                    'personal_destinos.perdest_observaciones',
                    'cargo.id as idcargo2',
                    'cargo.desc_cargo as cargo2'
                    )
            ->where('personal_destinos.perdest_codigocambio', '=', $per_codigo)
            ->where('personal_cargo.nivel_cargo',2)
            ->where('personal_destinos.perdest_flag',1)
            ->orderBy('personal_destinos.perdest_fechadestino','desc')
            ->paginate(50);

           //return response()->json($personal_destinos);
           return response()->json(['cargo1' => $personal_destinos,'cargo2' => $personal_destinos2]);
        }
        //fin else
        //return response()->json($request);
    }

    public function store(Request $request)
    {
         // PARA DEFINIR EL ESTADO
         $fecha_max_update = PersonalDestinos::
         where('perdest_codigocambio', $request->perdest_codigocambio)
         ->where('perdest_flag',1)
         ->max('perdest_fechadestino');
 
         if ($request->perdest_fechadestino >= $fecha_max_update)
            {
                $perdest_estado = '1';
 
                $excluir = PersonalDestinos::
                where('perdest_codigocambio', $request->perdest_codigocambio)
                ->whereNotIn('perdest_fechadestino', [$request->perdest_fechadestino])
                ->update(['perdest_estado' => 0]);

                $excluir_cargo = PersonalCargo::
                where('per_codigo', $request->perdest_codigocambio)
                ->whereNotIn('percar_fechadest', [$request->perdest_fechadestino])
                ->update(['percar_estado' => 0]);
            }
         else
             {
                $perdest_estado = '0';
             }
         //FIN DEFINIR ESTADO

         //PARA PONER FUNCION ASIGNARSE COMO DEFAULT

         if($request->perdest_cargo2 == null)
         {
             $idcargo2 = '369';
         }
     else
         {
             $idcargo2 = $request->perdest_cargo2;
         }
     
     //FIN DEFAULT
        $personal_destino = PersonalDestinos::create([
            //'CAMPO DE LA TABLA' => $request->NOMBRE Q VIENE DE LA VISTA
            'perdest_codigocambio' => $request->perdest_codigocambio,
            'perdest_destn1_codigo' => $request->perdest_destn1_codigo,
            'perdest_destn2_codigo' => $request->perdest_destn2_codigo,
            'perdest_destn3_codigo' => $request->perdest_destn3_codigo,
            'perdest_destn4_codigo' => $request->perdest_destn4_codigo,
            'perdest_nro_doc' => $request->perdest_nro_doc,
            'perdest_tipo_doc' => $request->perdest_tipo_doc,
            'perdest_fechadestino' => $request->perdest_fechadestino,
            'promocion' => $request->promocion,
            'perdest_estado' => $perdest_estado,
            'perdest_flag' => '1',
            'perdest_sysuser' => 'PRUEBA',
            'perdest_observaciones' => $request->perdest_observaciones,
        ]);
       // return response()->json($personal_destino);

        $personal_cargo1 = PersonalCargo::create([
            //'CAMPO DE LA TABLA' => $request->NOMBRE Q VIENE DE LA VISTA
            'cod_dest' => $personal_destino->id,
            'per_codigo' => $request->perdest_codigocambio,
            'id_cargo' => $request->perdest_cargo1,
            'nivel_cargo' => '1',
            'percar_estado' => $perdest_estado,
            'percar_flag' => '1',
            'percar_fechadest' => $request->perdest_fechadestino,
            'percar_observaciones' => $request->perdest_observaciones,
            'perdest_sysuser' => 'PRUEBA',
        ]);
        //return response()->json([$personal_destino,$personal_cargo]);

        $personal_cargo2 = PersonalCargo::create([
            //'CAMPO DE LA TABLA' => $request->NOMBRE Q VIENE DE LA VISTA
            //PARA PONER FUNCION ASIGNARSE COMO DEFAULT

            'cod_dest' => $personal_destino->id,
            'per_codigo' => $request->perdest_codigocambio,
            'id_cargo' => $idcargo2,
            'nivel_cargo' => '2',
            'percar_estado' => $perdest_estado,
            'percar_flag' => '1',
            'percar_fechadest' => $request->perdest_fechadestino,
            'percar_observaciones' => $request->perdest_observaciones,
            'perdest_sysuser' => 'PRUEBA',
        ]);
        return response()->json([$personal_destino,$personal_cargo1,$personal_cargo2]);

        //DB::beginTransaction();con esta sentecia decimos que vamos a insertar a varias tablas 
            //pero primero se llena la relacion fuerte 
        //if(!$request->ajax()) return view('/');
       
    }

    public function update(Request $request)
    {
        // PARA DEFINIR EL ESTADO
        $fecha_max_update = PersonalDestinos::
        where('perdest_codigocambio', $request->perdest_codigocambio)
        ->where('perdest_flag',1)
        ->max('perdest_fechadestino');
        /*$fecha_max_update = PersonalDestinos::
        select('perdest_fechadestino')
        ->where('perdest_codigocambio', $request->perdest_codigocambio)
        ->where('perdest_flag',1)
        ->orderBy('perdest_fechadestino','desc')
        ->first();*/

        if ($request->perdest_fechadestino >= $fecha_max_update)
            {
                $perdest_estado = '1';

                $excluir = PersonalDestinos::
                where('perdest_codigocambio', $request->perdest_codigocambio)
                ->whereNotIn('perdest_fechadestino', [$request->perdest_fechadestino])
                ->update(['perdest_estado' => 0]);

                $excluir_cargo = PersonalCargo::
                where('per_codigo', $request->perdest_codigocambio)
                ->whereNotIn('percar_fechadest', [$request->perdest_fechadestino])
                ->update(['percar_estado' => 0]);
            }
        else
            {
            /*$fecha_max_update = PersonalDestinos::
            where('perdest_codigocambio', $request->perdest_codigocambio)
            ->where('perdest_flag',1)
            ->max('perdest_fechadestino');*/

            $mayor_dest = PersonalDestinos::
                where('perdest_codigocambio', $request->perdest_codigocambio)
                ->where('perdest_fechadestino', $fecha_max_update)
                ->where('perdest_flag',1)
                ->update(['perdest_estado' => 1]);
                $perdest_estado = '0';

              /* $fecha_max_update = PersonalDestinos::
                where('perdest_codigocambio', $request->perdest_codigocambio)
                ->max('perdest_fechadestino');

               $mayor_dest = PersonalDestinos::
                where('perdest_codigocambio', $request->perdest_codigocambio)
                ->where('perdest_fechadestino', $fecha_max_update)
                ->update(['perdest_estado' => 1]);*/
            }
        //FIN DEFINIR ESTADO

        $personal_destinos = PersonalDestinos::where('id',$request->idPersonalDestino)
                    ->first();
        $personal_destinos -> update([
            'perdest_codigocambio' => $request->perdest_codigocambio,
            'perdest_nro_doc' => $request->perdest_nro_doc,
            'perdest_tipo_doc' => $request->perdest_tipo_doc,
            'perdest_fechadestino' => $request->perdest_fechadestino,
            'perdest_destn1_codigo' => $request->perdest_destn1_codigo,
            'perdest_destn2_codigo' => $request->perdest_destn2_codigo,
            'perdest_destn3_codigo' => $request->perdest_destn3_codigo,
            'perdest_destn4_codigo' => $request->perdest_destn4_codigo,
            'promocion' => $request->promocion,
            'perdest_estado' => $perdest_estado,
            //'perdest_flag' => '1',
            'perdest_observaciones' => $request->perdest_observaciones,
        ]);

        $personal_cargo1 = PersonalCargo::where('cod_dest',$request->idPersonalDestino)
                        ->where('nivel_cargo','1')
                        ->first();
        $personal_cargo1 -> update([
            'id_cargo' => $request->perdest_cargo1,
            'percar_fechadest' => $request->perdest_fechadestino,
            'percar_observaciones' => $request->perdest_observaciones,
            'percar_estado' => $perdest_estado,
            'perdest_sysuser' => 'ACTUALIZADOR',
        ]);

        $personal_cargo2 = PersonalCargo::where('cod_dest',$request->idPersonalDestino)
                        ->where('nivel_cargo','2')
                        ->first();
        $personal_cargo2 -> update([
            'id_cargo' => $request->perdest_cargo2,
            'percar_fechadest' => $request->perdest_fechadestino,
            'percar_observaciones' => $request->perdest_observaciones,
            'percar_estado' => $perdest_estado,
            'perdest_sysuser' => 'ACTUALIZADOR',
        ]);
        //return response()->json($request);
        return response()->json([$personal_destinos,$personal_cargo1,$personal_cargo2,$fecha_max_update]);
    }

    public function desactivarDestino(request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $personal_destinos = PersonalDestinos::findOrFail($request->idPersonalDestino);
        $personal_destinos->perdest_flag = '0';
        $personal_destinos->perdest_estado = '0';
        $personal_destinos->save();

        $desacCargo = PersonalCargo::
            where('cod_dest',$request->idPersonalDestino)
            ->update(['percar_estado' => 0,
                    'percar_flag' => 0]);

        $fecha_max_update = PersonalDestinos::
            where('perdest_codigocambio', $request->per_codigo)
            ->where('perdest_flag',1)
            ->max('perdest_fechadestino');

        $mayor_dest = PersonalDestinos::
            where('perdest_codigocambio', $request->per_codigo)
            ->where('perdest_fechadestino', $fecha_max_update)
            ->update(['perdest_estado' => 1]);

        $fecha_max_cargo = PersonalCargo::
            where('per_codigo', $request->per_codigo)
            ->where('percar_flag',1)
            ->max('percar_fechadest');

        $mayor_cargo = PersonalCargo::
            where('per_codigo', $request->per_codigo)
            ->where('percar_fechadest', $fecha_max_cargo)
            ->update(['percar_estado' => 1]);

        /*$excluir = PersonalDestinos::
            where('perdest_codigocambio', $request->per_codigo)
            ->whereNotIn('perdest_fechadestino', $fecha_max_update)
            ->update(['perdest_estado' => 0]);*/

        return response()->json([$personal_destinos,$fecha_max_update,$mayor_dest]);
    }
}









// if(!$request->ajax()) return redirect('/');//si la peticion no es tipo ajax que nos rerotne a la pagina prncipal
        //$usuarios = Usuario::all(); //con esta sentencia obtenemos todos los valores de la tabla usuario
        //return $usuarios; //con esto retornamos los valores

         /*$cargo1 = $this->Cargos($buscar_dest,1);
            $cargo2 = $this->Cargos($buscar_dest,2);
            $destinos = DB::table('personal_destinos as pd')
                        ->join('destinos_nivel3 as n3','pd.perdest_destn3_codigo','n3.id')
                        ->join('destinos_nivel4 as n4','pd.perdest_destn4_codigo','n4.id')
                        ->select('n3.destn3_descripcion','n4.destn4_descripcion')
                        ->where('pd.perdest_codigocambio',$buscar_dest)
                        ->orderBy('pd.perdest_fechadestino')
                        ->get();
            $data = [];
            $c = 0;
            foreach ($destinos as $key => $value) {
                $data[$key] = array(
                    "d3" => $value->destn3_descripcion,
                    "d4" => $value->destn4_descripcion,
                    "c1" => $cargo1[$c],
                    "c2" => $cargo2[$c]
                );
                $c += 1;
            }*/
        /* return response()->json(['cargo1' => $cargo1,
                    'cargo2' => $cargo2,
                    'destinos' => $destinos      
            ]);*/

            //return response()->json($request);
        /*return [
            'pagination' => [
                'total'         => $personal_destinos->total(),
                'current_page'  => $personal_destinos->currentPage(),
                'per_page'      => $personal_destinos->perPage(),
                'last_page'     => $personal_destinos->lastPage(),
                'from'          => $personal_destinos->firstItem(),
                'to'            => $personal_destinos->lastItem(),
            ],
            'personal_destinos' => $personal_destinos
        ];*/