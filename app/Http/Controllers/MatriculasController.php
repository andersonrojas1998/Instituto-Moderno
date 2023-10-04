<?php
namespace App\Http\Controllers;
use DB;
use App\User;
use Request;
use App\Model\alumno;
use App\Model\matricula;
use App\Model\acudiente;
use PDFMerger;
class MatriculasController extends Controller
{
    public function index(){
        return view('matricula.index_matricula');
    }
    public function index_create(){
        return view('matricula.index_created');
    }
    public function index_fichaMatricula(){
        return view('matricula.index_fichaMatricula');
    }    
    public function indexBookQualify(){
        return view('matricula.index_bookQualify');
    }
    public function  listChangeStatus(){
            $motivos=DB::SELECT("SELECT * FROM motivos_retiro");
            $estado=DB::SELECT("SELECT * FROM estado_matricula");
            return json_encode(['motivos'=>$motivos,'estados'=>$estado]);
    }
    public function edit_enrollement(){

        $id_grado=Request::input('id_grado');        
        $id_matricula=Request::input('id_matricula');
        $id_estado=Request::input('estado');
        $id_motivo=Request::input('motivo');
        
        if(isset($id_estado)){
            $matricula=DB::SELECT("UPDATE matricula SET id_grado='$id_grado', id_estado_matricula='$id_estado' , id_motivos_retiro='$id_motivo'  WHERE  id_matricula='$id_matricula'  ");
        }else{
            $matricula=DB::SELECT("UPDATE matricula SET id_grado='$id_grado'   WHERE  id_matricula='$id_matricula'  ");
        }
        return 1;        
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
             $data['data'][$key]['idGrado']=$us->idGrado;             
             $data['data'][$key]['actions']='';
         }
         return json_encode($data);          
    }
    public function pdfEnrollment($id_matricula,$status=1,$id_grade=0){ 
        
        if($status==1){
            return self::pdfDinamic($id_matricula);
        }else{
            $grade=BoletinController::studentsForGrades($id_grade); 
            $pdfM = new PDFMerger();           
            $arrMat=[];
            foreach(json_decode($grade)  as $xy=> $g){                
                $id_matricula=$g->id_matricula;              
                $arrMat[$xy]=$id_matricula;
                $student=DB::SELECT("CALL sp_infoEnrollementStudent('$id_matricula')  ");    
                $title="FICHA DE MATRICULA No. ". $student[0]->id_matricula;
                $GAA="GAA-FR-05";
                $responzable=DB::SELECT("SELECT tb3.nombre,tb3.identificacion,tb3.direccion,tb4.nombre AS barrio,tb3.telefono,tb3.profesion,tb3.empresa,tb3.viveCon,tb3.responsable,tipo_parentesco.nombre as parentesco from  matricula as tb1 
                INNER join alumno as tb2 on tb1.id_alumno=tb2.id_alumno inner join acudiente as tb3 on tb2.id_acudiente=tb3.id_acudiente inner join  barrio as tb4 on tb3.barrio_id=tb4.id_barrio
                inner join tipo_parentesco on tb3.id_tipo_parentesco=tipo_parentesco.id_tipo_parentesco
                WHERE tb1.id_matricula='$id_matricula'");
                $mother=DB::SELECT("SELECT tb3.nombre,tb3.identificacion,tb3.direccion,tb4.nombre AS barrio,tb3.telefono,tb3.profesion,tb3.empresa,IF(tb3.viveCon='1','SI','') as viveCon,tb3.responsable from  matricula as tb1 
                INNER join alumno as tb2 on tb1.id_alumno=tb2.id_alumno inner join acudiente as tb3 on tb2.id_madre=tb3.id_acudiente inner join  barrio as tb4 on tb3.barrio_id=tb4.id_barrio
                WHERE tb1.id_matricula='$id_matricula'");
                $father=DB::SELECT("SELECT tb3.nombre,tb3.identificacion,tb3.direccion,tb4.nombre AS barrio,tb3.telefono,tb3.profesion,tb3.empresa,IF(tb3.viveCon='1','SI','') as viveCon,tb3.responsable from  matricula as tb1 
                INNER join alumno as tb2 on tb1.id_alumno=tb2.id_alumno inner join acudiente as tb3 on tb2.id_padre=tb3.id_acudiente inner join  barrio as tb4 on tb3.barrio_id=tb4.id_barrio
                WHERE tb1.id_matricula='$id_matricula'");
                $pdf = \PDF::loadView('matricula.pdf_matricula',compact('title','GAA','student','responzable','mother','father'))->setPaper('letter')->setPaper('letter')->save( public_path('tmp/matricula/').$id_matricula.'.pdf');                
                $pdfM->addPDF(public_path('tmp/matricula/').$id_matricula.'.pdf', 'all');
                $arrMat[$xy]=$id_matricula;
            }
            $pdfM->merge('download', "mergedAllpdf.pdf");
            foreach($arrMat as $value){
                unlink(public_path('tmp/matricula/').$value.'.pdf');
            }
        }
        return $pdf;
    }
    public function pdfDinamic($id_matricula){
        
        $student=DB::SELECT("CALL sp_infoEnrollementStudent('$id_matricula')  ");    
        $title="FICHA DE MATRICULA No. ". $student[0]->id_matricula;
        $GAA="GAA-FR-05";
        $responzable=DB::SELECT("SELECT tb3.nombre,tb3.identificacion,tb3.direccion,tb4.nombre AS barrio,tb3.telefono,tb3.profesion,tb3.empresa,tb3.viveCon,tb3.responsable,tipo_parentesco.nombre as parentesco from  matricula as tb1 
        INNER join alumno as tb2 on tb1.id_alumno=tb2.id_alumno inner join acudiente as tb3 on tb2.id_acudiente=tb3.id_acudiente inner join  barrio as tb4 on tb3.barrio_id=tb4.id_barrio
        inner join tipo_parentesco on tb3.id_tipo_parentesco=tipo_parentesco.id_tipo_parentesco
        WHERE tb1.id_matricula='$id_matricula'");
        $mother=DB::SELECT("SELECT tb3.nombre,tb3.identificacion,tb3.direccion,tb4.nombre AS barrio,tb3.telefono,tb3.profesion,tb3.empresa,IF(tb3.viveCon='1','SI','') as viveCon,tb3.responsable from  matricula as tb1 
        INNER join alumno as tb2 on tb1.id_alumno=tb2.id_alumno inner join acudiente as tb3 on tb2.id_madre=tb3.id_acudiente inner join  barrio as tb4 on tb3.barrio_id=tb4.id_barrio
        WHERE tb1.id_matricula='$id_matricula'");
        $father=DB::SELECT("SELECT tb3.nombre,tb3.identificacion,tb3.direccion,tb4.nombre AS barrio,tb3.telefono,tb3.profesion,tb3.empresa,IF(tb3.viveCon='1','SI','') as viveCon,tb3.responsable from  matricula as tb1 
        INNER join alumno as tb2 on tb1.id_alumno=tb2.id_alumno inner join acudiente as tb3 on tb2.id_padre=tb3.id_acudiente inner join  barrio as tb4 on tb3.barrio_id=tb4.id_barrio
        WHERE tb1.id_matricula='$id_matricula'");
        $pdf = \PDF::loadView('matricula.pdf_matricula',compact('title','GAA','student','responzable','mother','father'))->setPaper('letter')->stream($GAA.".pdf");
        return $pdf;
    }    
    public function  pdfBookQualify($id_grade){        

        $grade=BoletinController::studentsForGrades($id_grade); 
            $pdfM = new PDFMerger();           
            $arrMat=[];
            foreach(json_decode($grade)  as $xy=> $g){                
                $id_matricula=$g->id_matricula;              
                $arrMat[$xy]=$id_matricula;
                $GAA="GAA-FR-05";                
                $allPeriods=DB::SELECT("CALL sp_qualifyStudentAllPeriods('$id_matricula') "); 
                $date=date('Y-m-d');
               // $write=DB::SELECT("CALL sp_averageAndRank('3','$id_grade')  ");
              //  $readTmp=DB::SELECT("SELECT promedio FROM temp_ranking WHERE id_matricula='$id_matricula' ");
              $periodo=3;


              $readTmp=DB::SELECT("CALL sp_averageAndRank('3','$id_grade','$id_matricula')  ");
              
             /* DB::SELECT("DROP TEMPORARY TABLE IF EXISTS temp_ranking;
              SET @numero=0;
              create temporary table IF NOT EXISTS temp_ranking as  
             SELECT  
               @numero:=@numero+1 AS puesto,
               AL.id_alumno,
              AL.identificacion,
              AL.nombre1 ,          
              (select round(AVG(nota_definitiva),2) from calificaciones AS C
              where  C.id_matricula=MT.id_matricula  AND id_periodo='$periodo') AS promedio
              from matricula AS MT 
              INNER JOIN grado as G on MT.id_grado=G.id_grado
              INNER JOIN alumno AS AL on MT.id_alumno=AL.id_alumno
              where G.id_grado='$id_grade'   AND  MT.año=YEAR(CURDATE())
              ORDER BY (select round(AVG(nota_definitiva),2) from calificaciones AS C where  C.id_matricula=MT.id_matricula  AND id_periodo='$periodo')  DESC;        
              SELECT puesto,promedio FROM temp_ranking WHERE id_matricula='$id_matricula';
              ");   */     
           //  validar si gano el año mediante  -- (por año para boletin y por acomulativo)




                $aprobo=($readTmp[0]->promedio >= 3.0)? 1:0;
                $student=DB::SELECT("CALL sp_infoStudent('$id_matricula')  ");
                $firstName=empty($student[0]->nombre1)? '':$student[0]->nombre1;
                $secondName=empty($student[0]->nombre2)? '':$student[0]->nombre2;
                $surname=empty($student[0]->apellido1)? '':$student[0]->apellido1;
                $secondSurname=empty($student[0]->apellido2)? '':$student[0]->apellido2;
                $fullname=$firstName.' '.$secondName .' '. $surname. '  '. $secondSurname;                
                $pdf = \PDF::loadView('matricula.pdf_bookQualify',compact('aprobo','allPeriods','date','student','fullname'))->setPaper('letter')->save( public_path('tmp/libro/').$id_matricula.'.pdf');                
                $pdfM->addPDF(public_path('tmp/libro/').$id_matricula.'.pdf', 'all');                
        }
        $pdfM->merge('download', "mergedAllpdf.pdf");
        foreach($arrMat as $value){
            unlink(public_path('tmp/libro/').$value.'.pdf');
        }        
        return $pdf;
    }


    public function searchAcudiente($dni){
       
        $acudiente=DB::SELECT("select * from acudiente  where identificacion='$dni'  limit  5 ");    
        return json_encode($acudiente);
    }

    public function searchStudent($dni){

        $data=[];
        $year=date('Y-m-d');
        $consul=DB::SELECT("SELECT * FROM matricula
        inner join alumno on matricula.id_alumno=alumno.id_alumno
        where alumno.identificacion='$dni' AND matricula.año='$year' ");

        $data['count']=count($consul);
        $alumno=DB::SELECT("SELECT * FROM alumno where identificacion='$dni' limit 1  ");
        $data['alumno']=$alumno;

        return json_encode($data);

    }
    public function registerEnrollment(){ 

        $barrios=DB::SELECT("SELECT * FROM barrio");
        $grupoEt=DB::SELECT("SELECT * FROM grupo_etnico");
        $tipoDoc=DB::SELECT("SELECT * FROM tipo_documento");
        $tipoEps=DB::SELECT("SELECT * FROM tipo_eps");
        $grados=DB::SELECT("SELECT * FROM grado");
        $parentesco=DB::SELECT("SELECT * FROM tipo_parentesco ");
        $discapacidades=DB::SELECT("SELECT * FROM tipo_discapacidad");        
        $Msena=DB::SELECT("SELECT * FROM modalidad_sena");

        return view('matricula.index_enrollment_out',compact('barrios','grupoEt','tipoDoc','tipoEps','grados','discapacidades','parentesco','Msena'));
    }
    public function storeEnrollement(){
                

    try{
        DB::transaction(function(){            
                $dniAcudiente=Request::input('ccAcudiente');               
                $acudiente=DB::SELECT("select id_acudiente as id from acudiente  where identificacion='$dniAcudiente' ");

                                    if(empty($acudiente)){
                                        $ac=new acudiente();
                                        $ac->nombre=Request::input('nameAcudiente');
                                        $ac->identificacion=$dniAcudiente;                                        
                                        $ac->id_tipo_parentesco = Request::input('parentesco');
                                        $ac->direccion= Request::input('dirAcudiente');
                                        $ac->barrio_id=Request::input('barrioAcudiente');
                                        $ac->telefono= Request::input('celAcudiente');
                                        $ac->updated_at=date('Y-m-d');
                                        $ac->responsable=1;
                                        $ac->save();
                                        $id_acudiente=$ac->id;                                                                                  
                                    }else{
                                        $id_acudiente=$acudiente[0]->id;                                           
                                   }                                  
                            

                            $id_padre='0';             
                            $dniPadre=Request::input('dniPadre');
                            $acudientePadre=DB::SELECT("select id_acudiente as id from acudiente  where identificacion='$dniPadre' ");
                            if(empty($acudientePadre)){                    
                                    $padre=new acudiente();
                                    $padre->nombre=Request::input('nombrePadre');
                                    $padre->identificacion=$dniPadre;                                    
                                    $padre->direccion=Request::input('direccionPadre');
                                    $padre->barrio_id=Request::input('barrioPadre');
                                    $padre->id_tipo_parentesco=15; /** Padre */
                                    $padre->telefono=Request::input('celPadre');
                                    $padre->profesion=Request::input('profesionPadre');
                                    $padre->empresa=Request::input('empresaPadre');
                                    $padre->updated_at=date('Y-m-d');
                                    $padre->save();
                                    $id_padre=$padre->id;                                      
                                }else{
                                    $id_padre=$acudientePadre[0]->id;                                      
                                }                                                                        
                          
                            $id_madre='0'; 
                            $dniMadre=Request::input('dniMadre');                           
                            $acudienteMadre=DB::SELECT("select id_acudiente as id from acudiente  where identificacion='$dniMadre' ");                    
                                if(empty($acudienteMadre)){                    
                                    $madre=new acudiente();
                                    $madre->nombre=Request::input('nombreMadre');
                                    $madre->identificacion=$dniMadre;
                                    $madre->id_tipo_parentesco =9;
                                    $madre->direccion=Request::input('direccionMadre');
                                    $madre->barrio_id= Request::input('barrioMadre');
                                    $madre->telefono=Request::input('celMadre');
                                    $madre->profesion=Request::input('profesionMadre');
                                    $madre->empresa= Request::input('empresaMadre');
                                    $madre->updated_at=date('Y-m-d');                                   
                                    $id_madre=$madre->id;
                                }else{
                                    $id_madre=$acudienteMadre[0]->id;                                        
                                }               
                              
                               
                            $dni=Request::input('dni');
                            $id_alumno='';
                            $alumno=DB::SELECT("SELECT * FROM alumno where identificacion = '$dni' ");    
                            if(empty($alumno[0])){
                                $alum= new alumno();
                                $alum->id_tipo_doc= Request::input('tipo_doc');
                                $alum->identificacion=$dni;
                                $alum->lugar_expedicion=Request::input('expedidoEn');
                                $alum->apellido1  =Request::input('firstLastName');
                                $alum->apellido2 =Request::input('secondLastName');
                                $alum->nombre1 =Request::input('firstName');
                                $alum->nombre2 =Request::input('secondName');
                                $alum->direccion =Request::input('direccion');
                                $alum->telefono	 =Request::input('tel');
                                $alum->id_barrio=Request::input('barrio'); 
                                $alum->id_departamento =1;
                                $alum->id_municipio=1;
                                $alum->id_acudiente=$id_acudiente;
                                $alum->id_padre=$id_padre;
                                $alum->id_madre=$id_madre;
                                $alum->id_tipo_eps=Request::input('eps');
                                $alum->password='$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni';
                                $alum->fecha_nacimiento=date('Y-m-d',strtotime(Request::input('dateBirthDay')));    
                                $alum->nac_muni=1;
                                $alum->nac_depto=1;                
                                $alum->genero=Request::input('sexo');
                                $alum->save(); 
                                $id_alumno=$alum->id;
                            } else{
                                $id_alumno=$alumno[0]->id_alumno;
                            }      

                                                   

                            $year=date('Y-m-d');
                            $consul=DB::SELECT("SELECT * FROM matricula
                            inner join alumno on matricula.id_alumno=alumno.id_alumno
                            where alumno.identificacion='$dni' AND matricula.año='$year' ");

                            if(empty($consul[0])){
                                $id_grado= Request::input('grado');
                                $grados=DB::SELECT("select * from  grado where id_grado='$id_grado' ");
                                
                                $mat=new matricula();
                                $mat->id_modalidad_sena= Request::input('id_modalidad_sena');
                                $mat->id_alumno=$alum->id;
                                $mat->año=date('Y');
                                $mat->viveCon=empty(Request::input('viveCon'))? '':implode(',',Request::input('viveCon'));
                                $mat->grado_cursar=$grados[0]->tag;
    
                                $mat->total_hermanos=Request::input('nmHermanos');                            
                                $mat->lugar_ocupa_hermanos=Request::input('lugarOcupa');
                                $mat->parientes_inmode=Request::input('parientes');
    
                                $mat->fecha_matricula=date('Y-m-d');
                                $mat->id_estado_matricula=1;
                                $mat->id_grado=$id_grado;
                                $mat->subsidiado= Request::input('subsidiado');
                                $mat->tipo_discapacidad=empty(Request::input('tipo_discapacidad'))? 4:Request::input('tipo_discapacidad');
                                $mat->grupo_etnico=Request::input('grupo_etnico');
                                $mat->id_sede=1;
                                $mat->id_tipo_matricula= Request::input('tipo_matricula');
                                $mat->inst_anterior=Request::input('colegioProviene');
                                $mat->ciudad_colegio_origen=Request::input('ciudadColegioProviene');
                                $mat->save();  
                            }                                                                                                                                              
                             return 1;            
                });                            
                } catch (Exception $th) {                
                    return response()->json(['message'=>'Error en la base de datos','error' => $th->getMessage()],400);              
                }   
    }
}
