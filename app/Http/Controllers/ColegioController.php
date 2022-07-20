<?php

namespace App\Http\Controllers;

use App\Colegios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ColegioController extends Controller
{
    public function index (Request $request)
    {
        $buscar = $request->buscar;
        // $criterio = $request->criterio;

        if($buscar=='')
        {
            $colegio = DB::table('colegios')
                        ->select(
                            'colegios.id',
                            'colegios.col_nombre',
                            'colegios.col_abreviatura',
                            'colegios.col_sie',
                            'colegios.col_foto',
                            'colegios.col_director',
                            'colegios.col_turno',
                            'colegios.col_dependencia',
                            'colegios.col_estado',
                            'colegios.col_observacion'
                        )
                        ->orderBy('colegios.col_nombre','asc')
                        ->take(1)
                        ->paginate(10);
        }
        else
        {
            $colegio = DB::table('colegios')
                        ->select(
                            'colegios.id',
                            'colegios.col_nombre',
                            'colegios.col_abreviatura',
                            'colegios.col_sie',
                            'colegios.col_foto',
                            'colegios.col_director',
                            'colegios.col_turno',
                            'colegios.col_dependencia',
                            'colegios.col_estado',
                            'colegios.col_observacion'
                        )
                        ->where('col_abreviatura','like','%'.$buscar.'%')
                        ->orWhere('col_sie','like','%'.$buscar.'%')
                        ->orderBy('colegios.col_nombre','asc')
                        ->take(1)
                        ->paginate(10);
        }
        return [
            'pagination' => [
                'total'         => $colegio->total(),
                'current_page'  => $colegio->currentPage(),
                'per_page'      => $colegio->perPage(),
                'last_page'     => $colegio->lastPage(),
                'from'          => $colegio->firstItem(),
                'to'            => $colegio->lastItem(),
            
            ],
            'colegio' => $colegio
        ];
        // return response()->json($colegio);
    }

    public function registrarColegio(Request $request)
    {
        if ($request->col_foto != "") {
            $exploded = explode(',', $request->col_foto);
            $decoded = base64_decode($exploded[1]);
            if (Str::contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
            } else {
                $extension = 'png';
            }
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i=0; $i < 10; $i++) {
               $randomString .= $characters[rand(0,$charactersLength - 1)];
            }
            $fileName = $randomString.($request->col_sie).$randomString.'.'.$extension;
            $path = public_path().'/img/colegio/'.$fileName;
            file_put_contents($path, $decoded);

        } else {
            $fileName = 'colegio.png';
        }
        $colegio = Colegios::create([
            //'CAMPO DE LA TABLA' => $request->NOMBRE Q VIENE DE LA VISTA
            'col_nombre' => $request->col_nombre,
            'col_abreviatura' => $request->col_abreviatura,
            'col_sie' => $request->col_sie,
            'col_foto' => $fileName,
            'col_director' => $request->col_director,
            'col_turno' => $request->col_turno,
            'col_dependencia' => $request->col_dependencia,
            'col_estado' => '1',
            'col_observacion' => $request->col_observaciones,
            'col_sysuser' => 'ADMIN',  
        ]);
    }

    public function updateColegio(Request $request)
    {
        $unidad = Colegios::findOrFail($request->col_id);
        $currentPhoto = $unidad->col_foto;
        if($request->col_foto != $currentPhoto){
            $exploded = explode(',', $request->col_foto);
            $decoded = base64_decode($exploded[1]);
            if (Str::contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
            } else {
                $extension = 'png';
            }
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i=0; $i < 10; $i++) { 
               $randomString .= $characters[rand(0,$charactersLength - 1)]; 
            }
            $fileName = $randomString.($request->col_sie).$randomString.'.'.$extension;
            $path = public_path().'/img/colegio/'.$fileName;
            file_put_contents($path, $decoded);
            $request->col_foto=$fileName; 
        }
        $colegio = Colegios::where('id',$request->col_id)
                    ->first();
        $colegio -> update([
            'col_nombre' => $request->col_nombre,
            'col_abreviatura' => $request->col_abreviatura,
            'col_sie' => $request->col_sie,
            'col_foto' => $request->col_foto,
            'col_director' => $request->col_director,
            'col_turno' => $request->col_turno,
            'col_dependencia' => $request->col_dependencia,
            'col_observacion' => $request->col_observaciones,
        ]);
    }

    public function desactivarColegio(Request $request)
    {
        $colegio = Colegios::findOrFail($request->col_id);
        $colegio->col_estado = '0';
        $colegio->save();
    }

    public function activarColegio(Request $request)
    {
        $colegio = Colegios::findOrFail($request->col_id);
        $colegio->col_estado = '1';
        $colegio->save();
    }

    public function selectColegio(Request $request){
        // if(!$request->ajax()) return view('/');
        $colegio = DB::table('colegios')
        ->select('id','col_abreviatura')
        ->where('col_estado',1)
        ->orderBy('col_abreviatura','asc')
        ->get();
        return response()->json($colegio);
    }

    public function datosColegio(Request $request)
    {
        $col_id = $request->col_id;
        $colegio = DB::table('colegios')
        ->select('id','col_abreviatura','col_sie','col_foto','col_director','col_turno','col_dependencia')
        ->where('id',$col_id)
        // ->orderBy('col_abreviatura','asc')
        ->first();
        return response()->json(['colegio' => $colegio]);
    }
}
