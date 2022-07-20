<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ReportesDestinosController extends Controller
{
    public function ReporteIndividualDestinos(Request $request)
    {
        $per_codigo = $request->per_codigo;

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
                'personal.per_cm',
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
                'personal_destinos.perdest_observaciones',
                'cargo.id as idcargo',
                'cargo.desc_cargo as cargo'
                )
        ->where('personal_destinos.perdest_codigocambio', '=', $per_codigo)
        ->where('personal_destinos.perdest_flag',1)
        ->where('personal_cargo.nivel_cargo',1)
        ->orderBy('personal_destinos.perdest_fechadestino','desc')
        ->get();

        $personal_destinos2 = DB::table("personal_destinos")
        ->join('personal','personal_destinos.perdest_codigocambio','=','personal.per_codigo')
        ->join('destinos_nivel1','personal_destinos.perdest_destn1_codigo','=','destinos_nivel1.id')
        ->join('destinos_nivel2','personal_destinos.perdest_destn2_codigo','=','destinos_nivel2.id')
        ->join('destinos_nivel3','personal_destinos.perdest_destn3_codigo','=','destinos_nivel3.id')
        ->join('destinos_nivel4','personal_destinos.perdest_destn4_codigo','=','destinos_nivel4.id')
        ->join('personal_cargo','personal_destinos.id','=','personal_cargo.cod_dest')
        ->join('cargo','personal_cargo.id_cargo','=','cargo.id')
        ->select('personal_destinos.id as idpersonal_destinos2',
                'destinos_nivel1.destn1_descripcion',
                'destinos_nivel2.destn2_descripcion',
                'destinos_nivel3.destn3_descripcion',
                'destinos_nivel4.destn4_descripcion',
                'personal.per_nombre',
                'personal.per_paterno',
                'personal.per_materno',
                'personal.per_cm',
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
                'personal_destinos.perdest_observaciones',
                'cargo.id as idcargo',
                'cargo.desc_cargo as cargo2'
                )
        ->where('personal_destinos.perdest_codigocambio', '=', $per_codigo)
        ->where('personal_destinos.perdest_flag',1)
        ->where('personal_cargo.nivel_cargo',2)
        ->orderBy('personal_destinos.perdest_fechadestino','desc')
        ->get();

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
        ->where('personal.per_codigo',$per_codigo)
        ->where('escalafon_personal.estado',1)
        ->where('estudio_personal.est_flag',1)
        ->first();
        
        $jefe_dpto = DB::table('personal')
        ->join('personal_destinos','personal_destinos.perdest_codigocambio','personal.per_codigo')
        ->join('escalafon_personal','personal.per_codigo','escalafon_personal.per_codigo')
        ->join('escalafones','escalafones.esca_codigo','escalafon_personal.esca_codigo')
        ->join('subescalafones','subescalafones.id','escalafon_personal.subesc_codigo')
        ->join('grados','grados.id','escalafon_personal.gra_codigo')
        ->join('estudio_personal','estudio_personal.per_codigo','personal.per_codigo')
        ->join('estudio','estudio.id','estudio_personal.est_codigo')
        ->join('destinos_nivel3','destinos_nivel3.id','personal_destinos.perdest_destn3_codigo')
        ->join('destinos_nivel4','destinos_nivel4.id','personal_destinos.perdest_destn4_codigo')
        ->join('personal_cargo','personal_cargo.cod_dest','personal_destinos.id')
        ->join('cargo','cargo.id','personal_cargo.id_cargo')
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
        ->where('destinos_nivel3.id',22)
        ->where('destinos_nivel4.id',69)
        ->where('cargo.id',68)
        ->where('escalafon_personal.estado',1)
        ->where('estudio_personal.est_flag',1)
        ->where('personal_cargo.nivel_cargo',1)
        ->orderBy('personal_destinos.perdest_fechadestino','desc')
        ->first();

        /*$qr = QrCode::format('png')->size(100)->margin(0)->merge('../public/assets/img/qr.png')->generate("NRO: $numDoc\n NOMBRE: $datosQr\n FECHA: $date\n ANTECEDENTE $casoQr");
        $codigo = $qr;*/
        $qr = QrCode::size(65)->generate("NOMBRES: $personal->per_nombre\n AP. PATERNO: $personal->per_paterno\n AP. MATERNO: $personal->per_materno\n");
        $codigo = $qr;

        $pdf = PDF::loadView('reportes.personalDestinos',['personal_destinos'=>$personal_destinos,'personal_destinos2'=>$personal_destinos2,'personal'=>$personal,'jefe_dpto'=>$jefe_dpto,'qr'=>$codigo])
       
        ->setPaper('letter', 'portrait');
        
        return $pdf->stream('reporte.pdf');
    }

    public function CertificadoIndividualDestinos(Request $request)
    {
        $per_codigo = $request->per_codigo;

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
                'personal.per_cm',
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
                'personal_destinos.perdest_observaciones',
                'cargo.id as idcargo',
                'cargo.desc_cargo as cargo'
                )
        ->where('personal_destinos.perdest_codigocambio', '=', $per_codigo)
        ->where('personal_destinos.perdest_flag',1)
        ->where('personal_cargo.nivel_cargo',1)
        ->orderBy('personal_destinos.perdest_fechadestino','asc')
        ->get();

        $personal_destinos2 = DB::table("personal_destinos")
        ->join('personal','personal_destinos.perdest_codigocambio','=','personal.per_codigo')
        ->join('destinos_nivel1','personal_destinos.perdest_destn1_codigo','=','destinos_nivel1.id')
        ->join('destinos_nivel2','personal_destinos.perdest_destn2_codigo','=','destinos_nivel2.id')
        ->join('destinos_nivel3','personal_destinos.perdest_destn3_codigo','=','destinos_nivel3.id')
        ->join('destinos_nivel4','personal_destinos.perdest_destn4_codigo','=','destinos_nivel4.id')
        ->join('personal_cargo','personal_destinos.id','=','personal_cargo.cod_dest')
        ->join('cargo','personal_cargo.id_cargo','=','cargo.id')
        ->select('personal_destinos.id as idpersonal_destinos2',
                'destinos_nivel1.destn1_descripcion',
                'destinos_nivel2.destn2_descripcion',
                'destinos_nivel3.destn3_descripcion',
                'destinos_nivel4.destn4_descripcion',
                'personal.per_nombre',
                'personal.per_paterno',
                'personal.per_materno',
                'personal.per_cm',
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
                'personal_destinos.perdest_observaciones',
                'cargo.id as idcargo',
                'cargo.desc_cargo as cargo2'
                )
        ->where('personal_destinos.perdest_codigocambio', '=', $per_codigo)
        ->where('personal_destinos.perdest_flag',1)
        ->where('personal_cargo.nivel_cargo',2)
        ->orderBy('personal_destinos.perdest_fechadestino','asc')
        ->get();

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
        ->where('personal.per_codigo',$per_codigo)
        ->where('escalafon_personal.estado',1)
        ->where('estudio_personal.est_flag',1)
        ->first();
        
        $jefe_dpto = DB::table('personal')
        ->join('personal_destinos','personal_destinos.perdest_codigocambio','personal.per_codigo')
        ->join('escalafon_personal','personal.per_codigo','escalafon_personal.per_codigo')
        ->join('escalafones','escalafones.esca_codigo','escalafon_personal.esca_codigo')
        ->join('subescalafones','subescalafones.id','escalafon_personal.subesc_codigo')
        ->join('grados','grados.id','escalafon_personal.gra_codigo')
        ->join('estudio_personal','estudio_personal.per_codigo','personal.per_codigo')
        ->join('estudio','estudio.id','estudio_personal.est_codigo')
        ->join('destinos_nivel3','destinos_nivel3.id','personal_destinos.perdest_destn3_codigo')
        ->join('destinos_nivel4','destinos_nivel4.id','personal_destinos.perdest_destn4_codigo')
        ->join('personal_cargo','personal_cargo.cod_dest','personal_destinos.id')
        ->join('cargo','cargo.id','personal_cargo.id_cargo')
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
        ->where('destinos_nivel3.id',22)
        ->where('destinos_nivel4.id',69)
        ->where('cargo.id',68)
        ->where('escalafon_personal.estado',1)
        ->where('estudio_personal.est_flag',1)
        ->where('personal_cargo.nivel_cargo',1)
        ->orderBy('personal_destinos.perdest_fechadestino','desc')
        ->first();

        /*$qr = QrCode::format('png')->size(100)->margin(0)->merge('../public/assets/img/qr.png')->generate("NRO: $numDoc\n NOMBRE: $datosQr\n FECHA: $date\n ANTECEDENTE $casoQr");
        $codigo = $qr;*/
        $qr = QrCode::size(65)->generate("NOMBRES: $personal->per_nombre\n AP. PATERNO: $personal->per_paterno\n AP. MATERNO: $personal->per_materno\n");
        $codigo = $qr;

        $pdf = PDF::loadView('reportes.certificadoDestinos',['personal_destinos'=>$personal_destinos,'personal_destinos2'=>$personal_destinos2,'personal'=>$personal,'jefe_dpto'=>$jefe_dpto,'qr'=>$codigo])
       
        ->setPaper('letter', 'portrait');
        
        return $pdf->stream('reporte.pdf');
    }
}
