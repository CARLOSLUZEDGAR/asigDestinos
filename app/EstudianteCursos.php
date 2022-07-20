<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstudianteCursos extends Model
{
    protected $table = 'estudiante_cursos';
    protected $fillable = ['id','cod_est','cod_col','cod_nivel','cod_curso','paralelo',
                            'gestion','estc_estado','estc_flag','estc_observacion','estc_sysuser'];
}
