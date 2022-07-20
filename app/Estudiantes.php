<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiantes extends Model
{
    protected $table = 'estudiantes';
    protected $fillable =['id','est_rude','est_paterno','est_materno','est_nombre',
                            'est_ci','est_expedido','est_estado','est_observacion','est_sysuser'];
}
