<?php
namespace App\Http\Controllers;
use DB;
use App\User;
use Request;

class MatriculasController extends Controller
{
    public function index(){
        return view('matricula.index_matricula');
    }
    public function index_create(){
        return view('matricula.index_created');
    }
    public function listEnrollment(){
        $year=date('Y');
        $dataUs=DB::select("CALL sp_enrollmentStudents('$year') ");
         $data=[];
         foreach($dataUs as $key => $us){                            
             $data['data'][$key]['id']=$us->id_matricula;
             $data['data'][$key]['grado']=$us->grupo  .' '. $us->jornada;
             $data['data'][$key]['fecha_matricula']=date('Y-m-d H:i',strtotime($us->fecha_matricula));
             $data['data'][$key]['name']=$us->apellido1. ' '.$us->apellido2.' ' . $us->nombre1.' '.$us->nombre2;
             $data['data'][$key]['estado']=$us->estado;             
             $data['data'][$key]['actions']='';
         }
         return json_encode($data);          
     }
}
