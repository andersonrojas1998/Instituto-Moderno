<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class grado extends Model
{
    protected $table="grado";



public function jornada(){
    return $this->hasOne('App\Model\Jornada', 'id_jornada', 'id_jornada');    
}


}
