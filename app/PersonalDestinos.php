<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalDestinos extends Model
{
    protected $table = 'personal_destinos';
    protected $fillable =['id','perdest_codigocambio','perdest_destn1_codigo','perdest_destn2_codigo',
                            'perdest_destn3_codigo','perdest_destn4_codigo','perdest_nro_doc','perdest_tipo_doc',
                            'perdest_fechadestino','promocion','perdest_estado','perdest_flag','perdest_sysuser','perdest_observaciones'];

}
