<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReporteController extends Controller
{
    public function listadoEstudiantes(Request $request)
    {
        $gestion = date('Y');
        $colegio = $request->idcol;
        $nivel = $request->idnivel;
        $curso = $request->idcurso;
        $paralelo = $request->idparalelo;
        $listado = DB::table('estudiantes')
        ->join('estudiante_cursos','estudiantes.id','estudiante_cursos.cod_est')
        ->join('colegios','colegios.id','estudiante_cursos.cod_col')
        ->join('niveles','niveles.id','estudiante_cursos.cod_nivel')
        ->join('cursos','cursos.id','estudiante_cursos.cod_curso')
        // ->join('paralelos','paralelos.id','estudiante_cursos.paralelo')
        ->select('estudiantes.est_rude',
                'estudiantes.est_paterno',
                'estudiantes.est_materno',
                'estudiantes.est_nombre')
        ->where('estudiante_cursos.estc_estado',1)
        ->where('colegios.id',$colegio)
        ->where('niveles.id',$nivel)
        ->where('cursos.id',$curso)
        ->where('estudiante_cursos.paralelo',$paralelo)
        ->where('estudiante_cursos.gestion',$gestion)
        ->get();

        $curso = DB::table('estudiantes')
        ->join('estudiante_cursos','estudiantes.id','estudiante_cursos.cod_est')
        ->join('colegios','colegios.id','estudiante_cursos.cod_col')
        ->join('niveles','niveles.id','estudiante_cursos.cod_nivel')
        ->join('cursos','cursos.id','estudiante_cursos.cod_curso')
        // ->join('paralelos','paralelos.id','estudiante_cursos.paralelo')
        ->select('colegios.col_nombre',
                'niveles.nivel_nombre',
                'cursos.curso_sigla',
                'estudiante_cursos.paralelo')
        ->where('estudiante_cursos.estc_estado',1)
        ->where('colegios.id',$colegio)
        ->where('niveles.id',$nivel)
        ->where('cursos.id',$curso)
        ->where('estudiante_cursos.paralelo',$paralelo)
        ->where('estudiante_cursos.gestion',$gestion)
        ->groupBy('colegios.col_nombre')
        ->groupBy('niveles.nivel_nombre')
        ->groupBy('cursos.curso_sigla')
        ->groupBy('estudiante_cursos.paralelo')
        ->first();

        $colegio = DB::table('colegios')
                    ->where('colegios.id',$colegio)
                    ->first();

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_emision = date('d')." de ".$meses[date('n')-1]." del ".date('Y');
        // $gestion = date('Y');
        // $qr = QrCode::encoding('UTF-8')->size(100)->generate("CERTIFICADO: $certificacion->id/$gestion\nGRADO: $certificacion->gra_abreviatura$certificacion->est_abreviatura\nAPELLIDO(S): $certificacion->per_paterno $certificacion->per_materno\nNOMBRE(S): $certificacion->per_nombre\nFECHA: $fecha_emision");
        // $codigo = $qr;

        $pdf = PDF::loadView('reportes.listadoEstudiantes',['listado'=>$listado,
                                                            'colegio'=>$colegio,
                                                            'curso'=>$curso
                                                            ])
        ->setPaper('letter', 'portrait');                                               
        
        return $pdf->stream('reporte.pdf');

    }   
}
