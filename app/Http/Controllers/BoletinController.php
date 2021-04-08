<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Model\matricula;
use App\Model\alumno;
use App\Model\acudiente;
use App\Model\grado;
use App\Model\curso;
use DB;

class BoletinController extends Controller
{
    
    public function index(){
        return view('boletin.index_boletin');
    }
    public function grades(){
        $grade=grado::all();
        return json_encode($grade);
    }
    public function studentsForGrades($grade){
        $alumnoGrade=DB::SELECT("SELECT B.id_matricula,A.nombre1,A.nombre2,A.apellido1,A.apellido2
                            FROM alumno AS A
                            INNER JOIN matricula AS B ON A.id_alumno=B.id_alumno
                            INNER JOIN grado AS C ON  B.id_grado=C.id_grado
                            WHERE B.id_estado_matricula=1 AND B.id_grado='$grade' ");  
        return json_encode($alumnoGrade);
    }
    public function genetedBulletin($matricula,$expedition,$period){            
        $periodtx=($period==1)?  'PRIMER':'SEGUNDO';
        $secondPeriod=($period==2)? ' ,(SELECT  nota_definitiva from calificaciones as tb1 where tb1.id_periodo=2 AND tb1.id_matricula=C.id_matricula  AND tb1.id_asignatura=A.id_asignatura LIMIT 1) as segundoPeriodo' : '';
        $course=DB::SELECT("SELECT A.id_asignatura,A.nombre,A.tag,B.intensidad_horaria,
        (SELECT  nota_definitiva from calificaciones as tb1 where tb1.id_periodo=1 AND tb1.id_matricula=C.id_matricula  AND tb1.id_asignatura=A.id_asignatura LIMIT 1) as primerPeriodo  $secondPeriod
        from asignatura as A
        inner join curso AS B ON A.id_asignatura=B.id_materia
        inner join grado AS D ON D.id_grado=B.id_grado
        inner join matricula as C ON D.id_grado=C.id_grado
        where  C.id_matricula='$matricula' ");

        $label=[]; $nota=[]; $col=[];
        foreach($course as $key=> $all){
                       
            if($period==1){
                $notaPeriodo=$all->primerPeriodo;
                $nota[]=$all->primerPeriodo;
            }else{
                $notaPeriodo=$all->segundoPeriodo;
                $nota[]=$all->segundoPeriodo;            
            }
            $label[]=$all->tag;            
            switch(floatval($notaPeriodo)){
               case (floatval($notaPeriodo)<='2.9' ):
                    $color='rgba(235,3,3,1)';
                break;
                case (floatval($notaPeriodo)>='3.0' &&  '3.9'>=floatval($notaPeriodo)):
                    $color='rgba(255,153,51,1)';
                break;
                case (floatval($notaPeriodo)>='4.0' &&  '4.5'>=floatval($notaPeriodo)):
                    $color='rgba(255,243,51,1)';
                break;
                case (floatval($notaPeriodo)>'4.5'):
                    $color='rgba(53,193,4,1)';
                break;
            }
            $col[]=$color;
        }
        $head=DB::SELECT("SELECT B.id_matricula,A.nombre1,A.nombre2,A.apellido1,A.apellido2,C.grupo,D.nombre as jornada,users.name as docente,E.nombre as acudiente
                        FROM alumno AS A
                        INNER JOIN acudiente as E ON A.id_Acudiente=E.id_acudiente
                        INNER JOIN matricula AS B ON A.id_alumno=B.id_alumno
                        INNER JOIN grado AS C ON  B.id_grado=C.id_grado
                        inner JOIN jornada as D ON C.id_jornada=D.id_jornada
                        LEFT JOIN users  ON C.id_docente=users.id
                        WHERE B.id_estado_matricula=1 AND B.id_matricula='$matricula' ");     
          $chart = new \QuickChart(array('width' => 710,'height' => 176));          
          $chart->setConfig('{            
            type: "bar",
            data: {
              labels: '.json_encode($label).' , 
              datasets: [{
                label: "Materias Cursadas",                
                data: '.json_encode($nota).',
                backgroundColor:'.json_encode($col).' ,
                borderWidth:"5px", 
                barThickness:"12",                     
              },
              {
                type: "line",
                label: "Nota minima para aprobar",
                data: [3, 3, 3, 3,3,3,3,3,3,3,3,3,3,3,3],
                fill: false,
                borderColor: "rgb(54, 162, 235,0.2)"
            }
              ]
            },
            options:{                                                                                                                   
            }
          }');     
        $url=$chart->getUrl();
        $pdf = \PDF::loadView('boletin.pdf_boletin',compact('url','course','expedition','head','periodtx','period'))->stream("achivo.pdf");
        return $pdf;
    }
    public function loadUser(){
        \Excel::load('public\Personal.xlsx', function($reader) {         
            $data=[];         
            $reader->each(function($row){                
                if(!empty($row->identificacion)){
                    $user= new User();                
                    $user->identificacion=$row->identificacion;
                    $user->name=$row->name;
                    $user->password=$row->password;
                    $user->celular=$row->celular;
                    $user->id_sede=1;
                    $user->cargo=$row->cargo;
                    $user->genero=$row->genero;
                    $user->save();                
                }                
            });
        });
    }
    public function loadGroup(){
        \Excel::load('public\grados.xlsx', function($reader) {         
            $data=[];         
            $reader->each(function($row){                
                if(!empty($row->nombre)){
                    $grado= new grado();                
                    $grado->nombre=$row->nombre;
                    $grado->grupo=$row->grupo;
                    $grado->id_jornada=$row->id_jornada;
                    $grado->id_nivel_educativo=$row->id_nivel_educativo;                    
                    $grado->tag=$row->tag;                    
                    $grado->save();                
                }                
            });
        });
    }
    public function loadCourseTeacher(){
        \Excel::load('public\cargaDocente2.xlsx', function($reader) {         
            $data=[];         
            $reader->each(function($row){     
               // if(!empty($row->id_grado)){
                    $grado= new curso();                
                    $grado->id_grado=$row->id_grado;
                    $grado->id_docente=$row->id_docente;
                    $grado->id_materia=$row->id_materia;
                    $grado->año=date('Y');
                    $grado->intensidad_horaria=$row->intensidad_horaria;
                    $grado->save();                
               // }                
            });
        });
    }

    public function loadExcelEnrollment(){

    \Excel::load('public\matriculas.xlsx', function($reader) {        
        $data=[];      
        $i=0;   
        $reader->each(function($row){                        
                try {
                    DB::transaction(function() use($row){                       
                            if(!empty($row->tipo_docestu)){
                                $modalidaId=3;
                                if (!empty($row->modalidad_sena)) {
                                    $modalidad=DB::SELECT("select id_modalidad_sena as id from  modalidad_sena where  tag LIKE '%$row->modalidad_sena%' ");
                                    $modalidaId=$modalidad[0]->id;
                                }
                                $grados=DB::SELECT("select id_grado as id from  grado where grupo='$row->grupo_grado' ");                               
                                $id_grado=isset($grados[0]->id)? $grados[0]->id:27;
                                

                                if(!empty($row->acudientenombre) && $row->acudientenombre!="N/A" ){
                                    $acudiente=DB::SELECT("select id_acudiente as id from acudiente  where identificacion='$row->cc' ");    
                                        if(empty($acudiente)){
                                            $ac=new acudiente();
                                            $ac->nombre=$row->acudientenombre;
                                            $ac->identificacion=$row->cc;
                                            $ac->expedida =$row->expedida;
                                            $ac->id_tipo_parentesco = $row->codigo_parentesco ;   /** colocar id parentesco */
                                            $ac->direccion=$row->direccionacudi;
                                            $ac->barrio_id=$row->codigo_barrio_acu;/**  colocar id */
                                            $ac->telefono=$row->telefonoacudiente;
                                            $ac->updated_at=date('Y-m-d');
                                            $ac->responsable=1;
                                            $ac->save();
                                            $id_acudiente=$ac->id;                                                                                  
                                        }else{
                                            $id_acudiente=$acudiente[0]->id;                                           
                                       }                                  
                                }

                                $id_padre='0';
                                if(!empty($row->ccpadre)  &&  $row->nombrepadre!="N/A" ){
                                    $acudientePadre=DB::SELECT("select id_acudiente as id from acudiente  where identificacion='$row->ccpadre' ");
                                    if(empty($acudientePadre)){
                        
                                        $padre=new acudiente();
                                        $padre->nombre=$row->nombrepadre;
                                        $padre->identificacion=$row->ccpadre;
                                        $padre->expedida=$row->expedidapadre;                                        
                                        $padre->direccion=$row->direccionpadre;
                                        $padre->barrio_id=$row->barriopadre;
                                        $padre->id_tipo_parentesco=15; /** Padre */
                                        $padre->telefono=$row->telefonopadre;
                                        $padre->profesion=$row->profesionpadre;
                                        $padre->empresa=$row->empresapadre;
                                        $padre->updated_at=date('Y-m-d');
                                        $padre->save();
                                        $id_padre=$padre->id;                                      
                                    }else{
                                        $id_padre=$acudientePadre[0]->id;                                      
                                    }                                                                        
                                }
                                $id_madre='0';
                                if( !empty($row->ccmadre)  && $row->nombremadre!="N/A"){                    
                                    $acudienteMadre=DB::SELECT("select id_acudiente as id from acudiente  where identificacion='$row->ccmadre' ");                    
                                    if(empty($acudienteMadre)){                    
                                        $madre=new acudiente();
                                        $madre->nombre=$row->nombremadre;
                                        $madre->identificacion= $row->ccmadre;
                                        $madre->expedida=$row->expedidamadre;
                                        $madre->id_tipo_parentesco =9;
                                        $madre->direccion=$row->direccionmadre;
                                        $madre->barrio_id=$row->codigo_barrio_madre; /** */
                                        $madre->telefono=$row->telefonomadre;
                                        $madre->profesion=$row->profesionmadre;
                                        $madre->empresa=$row->empresamadre; 
                                        $madre->updated_at=date('Y-m-d');                                   
                                        $id_madre=$madre->id;
                                    }else{
                                        $id_madre=$acudienteMadre[0]->id;                                        
                                    }                                    
                                }
                   
                                $alum= new alumno();
                                $alum->id_tipo_doc=$row->tipo_docestu;
                                $alum->identificacion=$row->documento;                    
                                $alum->lugar_expedicion=$row->exp_muni;
                                $alum->apellido1  =$row->apellido1;
                                $alum->apellido2 =$row->apellido2;
                                $alum->nombre1 =$row->nombre1;
                                $alum->nombre2 =$row->nombre2;
                                $alum->direccion =$row->direccion_residencia;
                                $alum->telefono	 =$row->telefono;
                                $alum->id_barrio= $row->codigo_barrio; // colocar id
                                $alum->id_departamento =1;
                                $alum->id_municipio=1;
                                $alum->id_acudiente=$id_acudiente;
                                $alum->id_padre=$id_padre;
                                $alum->id_madre=$id_madre;
                                $alum->id_tipo_eps=isset($row->codigo_eps)? $row->codigo_eps:25; /** colocar id  */
                                $alum->password='$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni';
                                $alum->fecha_nacimiento=date('Y-m-d',strtotime($row->fecha_nac));
                    
                                $alum->nac_muni=1;//$row->nac_mun;
                                $alum->nac_depto=1;//$row->NAC_DEPTO;
                    
                                $alum->genero=($row->genero=="MASCULINO")? 'M':'F';
                                $alum->save();                        
                                $mat=new matricula();
                                $mat->simat=$row->simat;
                                $mat->victima_conflicto=$row->poblacion_victima_del_conflicto;
                                $mat->id_modalidad_sena=$modalidaId;
                                $mat->id_alumno=$alum->id;
                                $mat->año=date('Y');
                                $mat->grupo_simat=$row->grupo_simat;
                                $mat->grado_cursar=strval($row->gradocursa);
                                $mat->fecha_matricula=date('Y-m-d');
                                $mat->id_estado_matricula=1;
                                $mat->id_grado=$id_grado;     
                                $mat->subsidiado=$row->subsidiado;  
                                $mat->tipo_discapacidad=$row->tipo_discapacidad;
                                $mat->grupo_etnico= isset($row->grpo_etnico)? $row->grpo_etnico:2;
                                $mat->id_sede=1;
                                $id_tp_matricula=3;
                                if($row->repitente=="SI"){
                                    $id_tp_matricula=2;
                                }elseif ($row->nuevo) {
                                    $id_tp_matricula=1;
                                }                        
                                $mat->id_tipo_matricula=$id_tp_matricula;            
                                $mat->inst_anterior=$row->institucion_anterior;
                                $mat->ciudad_colegio_origen=$row->ciudad_colegio_origen;
                                $mat->save();                            
                           }                     
                    });                            
                    } catch (Exception $th) {                
                        return response()->json(['message'=>'Error en la base de datos','error' => $th->getMessage()],400);              
                    }
        });                                 
    })->get();
}
}