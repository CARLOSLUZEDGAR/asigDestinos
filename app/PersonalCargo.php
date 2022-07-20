<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalCargo extends Model
{
    protected $table = 'personal_cargo';
    protected $fillable =['id','cod_dest','per_codigo','id_cargo','nivel_cargo','percar_estado','percar_flag',
                        'percar_fechadest','percar_observaciones','percar_sysuser'];   
}
