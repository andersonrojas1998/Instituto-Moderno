<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class GradeController extends Controller
{
  public function index(){
      return view('grados.index_grados');
  }
  public function gradesAll(){
    return json_encode(DB::SELECT("SELECT id_grado,grupo FROM grado"));
  }
  public function dt_grades(){
   $grados=DB::SELECT("SELECT tb1.nombre,tb1.grupo,tb2.nombre as jornada,users.name,(SELECT count(*) from matricula as tb3 where  tb3.id_grado=tb1.id_grado AND tb3.id_estado_matricula=1) as alumnos from grado as tb1
                        INNER join jornada as tb2 on tb1.id_jornada=tb2.id_jornada
                        LEFT join users  on tb1.id_docente=users.id");
    $data=[];
    foreach($grados as $key => $us){                            
        $data['data'][$key]['con']=$key;   
        $data['data'][$key]['nombre']=$us->nombre;
        $data['data'][$key]['grupo']=$us->grupo;   
        $data['data'][$key]['jornada']=$us->jornada;   
        $data['data'][$key]['name']=$us->name;
        $data['data'][$key]['alumnos']=$us->alumnos;        
        $data['data'][$key]['actions']='';
    }
    return json_encode($data);
  }
}
