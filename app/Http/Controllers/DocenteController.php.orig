<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DocenteController extends Controller
{
    public function index(){
        return view('docentes.index_docentes');
    }
    public function showTeacher($status=1){
        $dataUs=DB::select("SELECT tb1.id,tb1.name FROM users as tb1  WHERE tb1.estado='$status' ");        
        return json_encode($dataUs);
    }

    public function dt_user(){
       $dataUs=DB::select("SELECT tb1.identificacion,tb1.name,tb1.estado,tb1.celular,tb2.nombre as sede,tb1.cargo,tb1.genero FROM users as tb1 inner join sede as tb2 on tb1.id_sede=tb2.id_sede");
        $data=[];
        foreach($dataUs as $key => $us){                            
            $data['data'][$key]['con']=$key;   
            $data['data'][$key]['dni']=$us->identificacion;
            $data['data'][$key]['name']=$us->name;   
            $data['data'][$key]['celular']=$us->celular;
            $data['data'][$key]['genero']=$us->genero;
            $data['data'][$key]['sede']=$us->sede;
            $data['data'][$key]['cargo']=$us->cargo;
            $data['data'][$key]['estado']=$us->estado;
        }
        return json_encode($data);          
    }
    public function gradeAssignments(){        
        $idTeacher = \Request::input('idTeacher');
        $gradesAll=DB::SELECT("SELECT distinct A.id_grado, concat(A.grupo,' * ',c.nombre) as grupo FROM  grado as A
                    inner join curso AS B ON A.id_grado=B.id_grado
                    inner join jornada as C ON A.id_jornada=C.id_jornada         
                    where B.id_docente='$idTeacher' ");
        return json_encode($gradesAll);
    }
    public function assignmentCourseTeacher(Request $rs){
        $res=$rs->all();             
        $teacher=$res['idTeacher'];
        $grade=$res['idgrade'];
        $course=DB::SELECT("SELECT A.id_asignatura,A.nombre from asignatura as A inner join curso AS B ON A.id_asignatura=B.id_materia where B.id_docente='$teacher' AND B.id_grado='$grade' ");
        return json_encode($course);
    }
}
