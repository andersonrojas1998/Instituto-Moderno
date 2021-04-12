<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class EstudiantesController extends Controller
{
    public function index(){
        return view('estudiantes.index_estudiantes');
    }


    public function dt_alumn(){
        $dataAlumn=DB::select("SELECT tb1.identificacion,tb1.apellido1,tb1.apellido2,tb1.nombre1,tb1.nombre2,tb1.genero,
        tb1.direccion,tb1.telefono,tipo_eps.nombre as eps,tb2.nombre as acudiente,tb2.telefono as telAcudiente,tb1.estado
        FROM alumno as tb1
        INNER JOIN  tipo_eps on tb1.id_tipo_eps=tipo_eps.id_tipo_eps
        INNER JOIN acudiente as tb2 on tb1.id_acudiente=tb2.id_acudiente");

         $data=[];
         foreach($dataAlumn as $key => $us){                            
             $data['data'][$key]['con']=$key;   
             $data['data'][$key]['dni']=$us->identificacion;
             $data['data'][$key]['apellido1']=$us->apellido1;   
             $data['data'][$key]['apellido2']=$us->apellido2;
             $data['data'][$key]['nombre1']=$us->nombre1;
             $data['data'][$key]['nombre2']=$us->nombre2;
             $data['data'][$key]['genero']=$us->genero;
             $data['data'][$key]['direccion']=$us->direccion;
             $data['data'][$key]['telefono']=$us->telefono;
             $data['data'][$key]['eps']=$us->eps;
             $data['data'][$key]['acudiente']=$us->acudiente;
             $data['data'][$key]['telAcudiente']=$us->telAcudiente;
             $data['data'][$key]['estado']=$us->estado;
         }
         return json_encode($data);          
     }
}
