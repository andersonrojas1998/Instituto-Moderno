<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
class CalificacionesController extends Controller
{
    public function index(){        
        return view('calificaciones.index_calificaciones');
    }
    public function indexLoadExcelFormat(){        
        return view('calificaciones.importExcel');
    }
    public function indexSummaryRating(){        
        return view('calificaciones.summaryRating');
    }
    public function alumnCourse(){

    $grade = \Request::input('grade');
    $period = \Request::input('perid');    
    $teacher=\Request::input('teacher');
    $course=\Request::input('course');

    $alumnoGrade=DB::SELECT("SELECT B.id_matricula,A.nombre1,A.nombre2,A.apellido1,A.apellido2,C.grupo,
                                (SELECT  nota_definitiva from calificaciones as tb1 where tb1.id_periodo=1 AND tb1.id_matricula=B.id_matricula AND tb1.id_docente='$teacher' AND tb1.id_asignatura='$course' LIMIT 1) as primerPeriodo,
                                (SELECT  nota_definitiva from calificaciones as tb2 where tb2.id_periodo=2 AND tb2.id_matricula=B.id_matricula AND tb2.id_docente='$teacher' AND tb2.id_asignatura='$course' LIMIT 1) as segundoPeriodo,
                                (SELECT  nota_definitiva from calificaciones as tb3 where tb3.id_periodo=3 AND tb3.id_matricula=B.id_matricula AND tb3.id_docente='$teacher' AND tb3.id_asignatura='$course' LIMIT 1) as tercerPeriodo
                            FROM alumno AS A
                            INNER JOIN matricula AS B ON A.id_alumno=B.id_alumno
                            INNER JOIN grado AS C ON  B.id_grado=C.id_grado
                            WHERE B.id_estado_matricula=1 AND B.id_grado='$grade' ORDER BY A.apellido1 ASC  ");                            
        $data=[]; $i=1;
        foreach($alumnoGrade as $key => $row){
            $data['data'][$key]['conc'] = $i;
            $data['data'][$key]['mat'] = $row->id_matricula;
            $data['data'][$key]['alumn'] =$row->apellido1. ' '.$row->apellido2.' ' . $row->nombre1.' '.$row->nombre2;
            $data['data'][$key]['grupo']=$row->grupo;
            $data['data'][$key]['period1']=(empty($row->primerPeriodo))? '':number_format($row->primerPeriodo,1);
            $data['data'][$key]['period2']=(empty($row->segundoPeriodo))? '' :number_format($row->segundoPeriodo,1);
            $data['data'][$key]['period3']=(empty($row->tercerPeriodo))?  '':number_format($row->tercerPeriodo,1);
            $data['data'][$key]['notas']='';
            ++$i;
        }
        return $data;
    }
    public function summaryRating($period){    
        $id_user=Auth::user()->id;
        $grades=DB::SELECT("SELECT distinct(tb3.id_asignatura),tb1.id_grado,tb1.nombre,tb1.grupo,tb3.created_at,tb4.nombre as asignatura,tb4.id_asignatura FROM grado as tb1
                            inner join matricula as tb2 on tb1.id_grado=tb2.id_grado
                            inner join calificaciones as tb3 on tb2.id_matricula=tb3.id_matricula
                            inner join asignatura as tb4 on tb3.id_asignatura=tb4.id_asignatura
                            where tb2.id_estado_matricula=1 AND tb3.id_docente='$id_user' AND tb3.id_periodo='$period' ");
            $data=[]; $i=1;
            foreach($grades as $key => $row){
                $data['data'][$key]['conc'] = $i;
                $data['data'][$key]['id_grado'] = $row->id_grado;
                $data['data'][$key]['nombre'] = $row->nombre;
                $data['data'][$key]['grupo']=$row->grupo;
                $data['data'][$key]['asignatura']=$row->asignatura;
                $data['data'][$key]['id_asignatura']=$row->id_asignatura;
                $data['data'][$key]['created']=date('Y-m-d',strtotime($row->created_at));
                $data['data'][$key]['status']=1;
                $data['data'][$key]['actions']=$id_user;
                ++$i;
            }
            return $data;
        }

    public function generatedEnrollmentQualification($grade,$teacher,$period,$course){                  
        $aco=($period==3)? 2:1;                                  
        $alumnoGrade=DB::SELECT("SELECT B.id_matricula,A.nombre1,A.nombre2,A.apellido1,A.apellido2,C.grupo,
                                    (SELECT  nota_definitiva from calificaciones as tb1 where tb1.id_periodo=1 AND tb1.id_matricula=B.id_matricula AND tb1.id_docente='$teacher' AND tb1.id_asignatura='$course'  LIMIT 1) as primerPeriodo,
                                    (SELECT  nota_definitiva from calificaciones as tb2 where tb2.id_periodo=2 AND tb2.id_matricula=B.id_matricula AND tb2.id_docente='$teacher' AND tb2.id_asignatura='$course'  LIMIT 1) as segundoPeriodo,                                    
                                    (SELECT  acumulativo from calificaciones as tb3 where tb3.id_periodo='$aco' AND tb3.id_matricula=B.id_matricula AND tb3.id_docente='$teacher' AND tb3.id_asignatura='$course'  LIMIT 1) as acumulativo
                            FROM alumno AS A
                            INNER JOIN matricula AS B ON A.id_alumno=B.id_alumno
                            INNER JOIN grado AS C ON  B.id_grado=C.id_grado
                            WHERE B.id_estado_matricula=1 AND B.id_grado='$grade' ORDER BY A.apellido1 ASC ");

        $users=DB::SELECT("SELECT name  from  users WHERE id='$teacher' ");
        $curso=DB::SELECT("SELECT nombre  from  asignatura WHERE id_asignatura='$course' ");
        $data=[];
        $data=['students'=>$alumnoGrade,'course'=>$curso[0]->nombre,'grade'=>$alumnoGrade[0]->grupo,'period'=>$period,'teacher'=>$users[0]->name];
                   
        \Excel::create('PlantillaNotas', function($excel) use($data) {  

            $excel->sheet($data['grade'], function($sheet) use($data) {
                $sheet->setStyle(array('font'=>array('name'=>'Arial','size'=>11)));
                self::drawings('A1',$sheet,90,115); 


                $styleArray = array( 'font' => array( 'bold' => true ) );  /** Negrita */
                $styleTitle = array('alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER), 'font' => array( 'bold' => true )); /** Titulo */
                $styleCenter=array('alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER)); 
              
               $sheet->setCellValue('A2','INSTITUTO MODERNO DESEPAZ');
               $sheet->setCellValue('A3','Resolución No 4143.010.21.9981 del 18 de Diciembre de 2017 de la Secretaría de Educación.');
               $sheet->setCellValue('A4','PLANILLA DE EVALUACIÓN');
               $sheet->setCellValue('A5','PERIODO : '.$data['period']);
               $sheet->setCellValue('A6','DOCENTE : '.$data['teacher']);
                $letter=0;                
                $acb=['A','B','C', 'D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
                $sheet->setCellValue('A11','GRADO : '.$data['grade']);
                $sheet->mergeCells('A11:B11');
                $sheet->getStyle('A11')->applyFromArray($styleCenter);

                $sheet->setCellValue('A12','ASIGNATURA : '.$data['course']);
                $sheet->mergeCells('A12:B12');
                $sheet->getStyle('A12')->applyFromArray($styleCenter);

                $sheet->setCellValue('C11','Periodo');
                $sheet->mergeCells('C11:F12');
                $sheet->getStyle('C11')->applyFromArray($styleTitle);


                $sheet->setCellValue('G11','Interpretativa');
                $sheet->mergeCells('G11:J12');
                $sheet->getStyle('G11')->applyFromArray($styleTitle);
                            
                $sheet->setCellValue('K11','Argum');
                $sheet->mergeCells('K11:M12');
                $sheet->getStyle('K11')->applyFromArray($styleTitle);
                
                $sheet->setCellValue('N11','Propo');
                $sheet->mergeCells('N11:P12');
                $sheet->getStyle('N11')->applyFromArray($styleTitle);


                $sheet->setCellValue('Q11','Social');
                $sheet->mergeCells('Q11:S12');
                $sheet->getStyle('Q11')->applyFromArray($styleTitle);


                $sheet->setCellValue('T11','AutoE');
                $sheet->mergeCells('T11:U12');
                $sheet->getStyle('T11')->applyFromArray($styleTitle);

             $title=['Matricula','Estudiante','1','2','3','4','i1','i2','i3','i4','a1','a2','a3','p1','p2','p3','s1','s2','s3', 'au1','au2','def'];
             
                for($x=0;$x<count($title);$x++){                                                           
                    $sheet->getStyle($acb[$letter].'13')->applyFromArray($styleArray);
                    $sheet->setCellValueByColumnAndRow($x,13,$title[$x]);                      
                    $sheet->setCellValueByColumnAndRow($x,1,$title[$x]);                      
                    ++$letter;
                }
                $sheet->getStyle('A1:V1')->applyFromArray( [
                    'font' => [
                        'color' => ['rgb' => 'FFFFFF'],
                 ]
                ]);

                $sheet->mergeCells('A2:'.$acb[$letter-1].'2');
                $sheet->mergeCells('A3:'.$acb[$letter-1].'3');
                $sheet->mergeCells('A4:'.$acb[$letter-1].'4');
                $sheet->mergeCells('A5:'.$acb[$letter-1].'5');
                $sheet->mergeCells('A6:'.$acb[$letter-1].'6');
                $sheet->mergeCells('A7:'.$acb[$letter-1].'7');
                $sheet->getStyle('A2:'.$acb[$letter-1].'2')->applyFromArray($styleTitle);             
                $sheet->cells('A1:'.$acb[$letter-1].'7', function ($cells) {
                    $cells->setBackground('#FFFDFD');
                    $cells->setAlignment('center');                    
                    $cells->setBorder('thin','thin','thin','thin');                    
                });
                $row=0;
                $alu=14;             
                foreach($data['students'] as $key=> $alumno){                   
                    $sheet->setCellValueByColumnAndRow($row,$alu,$alumno->id_matricula);                   
                    $name=$alumno->apellido1.'  '.$alumno->apellido2.'  ' .$alumno->nombre1.'  '. $alumno->nombre2;
                    $sheet->setCellValueByColumnAndRow($row+1,$alu,$name);
                    $sheet->setCellValueByColumnAndRow($row+2,$alu,(empty($alumno->primerPeriodo))? '':number_format($alumno->primerPeriodo,1));
                    $sheet->setCellValueByColumnAndRow($row+3,$alu,(empty($alumno->segundoPeriodo))? '':number_format($alumno->segundoPeriodo,1));
                    $sheet->setCellValueByColumnAndRow($row+21,$alu,(empty($alumno->acumulativo))? '':number_format($alumno->acumulativo,1));
                    
                    ++$alu;
                }
                $sheet->setBorder('A13:W'.($alu-1), 'thin');

                $sheet->cells('A11:V13', function ($cells) {
                    $cells->setBackground('#E1D9D9');
                    $cells->setAlignment('center');
                    $cells->setBorder('thin','thin','thin','thin');
                });
                $sheet->setFreeze('A14');
                $sheet->protect('123456');
                $sheet->getStyle('G14:U100')->getProtection()->setLocked(\PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);                                
            });

        })->download('xls');    
    }

    
    public function readEnrollmentQualification(){
        
        $data=[];
        \Excel::load($_FILES['file']['tmp_name'], function($reader) use(&$data){
        $sheet = $reader->getSheet(0);
        $grade=substr($sheet->getCell('A11')->getValue(),8,strlen($sheet->getCell('A12')->getValue())); 
        $course=substr($sheet->getCell('A12')->getValue(),13,strlen($sheet->getCell('A12')->getValue())); 
        $perid=intval(substr($sheet->getCell('A5')->getValue(),9,strlen($sheet->getCell('A5')->getValue()))); 
        $teacher=substr($sheet->getCell('A6')->getValue(),10,strlen($sheet->getCell('A6')->getValue()));
        $reader->ignoreEmpty();
        $reader->takeColumns(22);        
        $singleRow =$reader->skipRows(12)->get(); 
        
        $users=DB::SELECT("SELECT id  from  users WHERE name='$teacher' ");
        $curso=DB::SELECT("SELECT id_asignatura  from  asignatura WHERE nombre='$course' ");
        $data=['period'=>$perid,'teacher'=>$users[0]->id,'course'=>$curso[0]->id_asignatura,'grade'=>$grade];    
                
        $exception = DB::transaction(function() use ($data,$reader) {
            try {   
                $reader->each(function($row) use ($data){             
                if (!$row->filter()->isEmpty()) {
                        $perid=$data['period'];
                        $matricula=intval($row->matricula); 
                        $teacher=$data['teacher'];
                        $course=$data['course'];


                        /** Interpretativa 34% */
                        $nota1=number_format ($row->i1,1); //floatval(); 
                        $nota2=number_format ($row->i2,1);
                        $nota3=number_format ($row->i3,1);
                        $nota4=number_format ($row->i4,1);
                        /** Argumentativa  34% */
                        $nota5=number_format($row->a1,1);
                        $nota6=number_format($row->a2,1);
                        $nota7=number_format($row->a3,1);
                        /** Propositiva   30%  */
                        $nota8=number_format($row->p1,1);
                        $nota9=number_format($row->p2,1);
                        $nota10=number_format($row->p3,1);
                        /**Social 1% */
                        $nota11=number_format($row->s1,1);
                        $nota12=number_format($row->s2,1);
                        $nota13=number_format($row->s3,1);                        
                        /**Autoe  1%  */
                        $nota14=number_format($row->au1,1);
                        $nota15=number_format($row->au2,1);
                        
                       

                     $year=date('Y');
                     $calificaciones=DB::SELECT("SELECT id_matricula FROM calificaciones WHERE  id_periodo='$perid' AND id_docente='$teacher' AND  id_asignatura='$course' AND id_matricula='$matricula' ");
                     if(!empty($calificaciones[0]->id_matricula)){
                        throw new \Exception(json_encode(['error'=>1,'message'=>'El alumno con matricula '. $calificaciones[0]->id_matricula .' ya cuenta con calificacion para el periodo '.$perid,'colum'=>$matricula ]));
                     }
                                          
                     if($nota1 >5.0 ||  $nota2 >5.0 || $nota3 >5.0  || $nota4>5.0 ||  $nota5 >5.0 || $nota6 >5.0  || $nota7 >5.0 || $nota8>5.0 || $nota9>5.0 || $nota10>5.0 ||  $nota11>5.0 ||  $nota12>5.0 ||  $nota13>5.0  ||  $nota14>5.0  ||  $nota15>5.0  ){
                         throw new \Exception(json_encode(['error'=>1,'message'=>'Por favor valida todos los campos , revisa que  La nota no supere  a 5.0 ','colum'=>$matricula ]));
                     }
                     
       
                $i=0;
                if($nota1 >0.0){
                    ++$i;
                }if ($nota2 > 0.0) {
                    ++$i;
                }if ($nota3 > 0.0) {
                    ++$i;
                }if ($nota4 > 0.0) {
                    ++$i;
                }

                if($i==0){
                    throw new \Exception(json_encode(['error'=>1,'message'=>'Por favor Ingrese al menos 1 nota en Interpretativa ','colum'=>$matricula ]));
                }
                $interPro=($nota1+$nota2+$nota3+$nota4)/$i;
                
                $a=0;
                if($nota5 >0.0){
                    $a++;
                }if ($nota6 > 0.0) {
                    ++$a;
                }if($nota7 > 0.0) {
                    ++$a;
                }  

                if($a==0){
                    throw new \Exception(json_encode(['error'=>1,'message'=>'Por favor Ingrese al menos 1 nota en Argumentativa ','colum'=>$matricula ]));
                }      
                $argPro=($nota5+$nota6+$nota7)/$a;

                $p=0;
                if($nota8 >0.0){
                    ++$p;
                }if($nota9 > 0.0) {
                    ++$p;
                }if($nota10 > 0.0) {
                    ++$p;
                } 
                
                if($p==0){
                    throw new \Exception(json_encode(['error'=>1,'message'=>'Por favor Ingrese al menos 1 nota en Propositiva ','colum'=>$matricula ]));
                } 
                $proPro=($nota8+$nota9+$nota10)/$p;

                $s=0;
                if($nota11 >0.0){
                    ++$s;
                }if($nota12 > 0.0) {
                    ++$s;
                }if ($nota13 > 0.0) {
                    ++$s;
                }   
                
                if($s==0){
                    throw new \Exception(json_encode(['error'=>1,'message'=>'Por favor Ingrese al menos 1 nota en Social ','colum'=>$matricula ]));
                } 
                $socPro=($nota11+$nota12+$nota13)/$s;

                $aut=0;
                if($nota14 >0.0){
                    ++$aut;
                }if($nota15 > 0.0) {
                    ++$aut;
                }

                if($aut==0){
                    throw new \Exception(json_encode(['error'=>1,'message'=>'Por favor Ingrese al menos 1 nota en Autoe ','colum'=>$matricula ]));
                }
        
                $autoPro=($nota14+$nota15)/$aut;
                
                $inter=round(($interPro)*34/ 100,2);
                $argum=round(($argPro)*34/ 100, 2);

                $propo=round(($proPro)*30/100,2);
                $social=round(($socPro)*1/100,2);
                $autoe=round(($autoPro)*1/100,2);
                            
                $notafinal=number_format($inter+$argum+$propo+$social+$autoe,1);
            
                $i=0;$a=0;$p=0;$s=0;$aut=0;

                        /// validar lo del 2 perido acomulativo                   
                        $percentage=DB::SELECT("SELECT porcentaje from periodo where codigo='$perid' ");
                        $acomulativo=number_format(($notafinal*$percentage[0]->porcentaje/100),1);
                        ($row->def!=null)? $acomulativo+number_format($row->def,1):'';
     
                        $aprobo=($notafinal > 3.0)? 1:0;

                        $color=""; $rangoT=""; $letra="";
                        switch(floatval($notafinal)){
                            case (floatval($notafinal)>'0.0' && floatval($notafinal)<='2.9' ):
                                 $color="rgba(235,3,3,1)";
                                 $rangoT="BAJO";
                                 $letra="BJ";
                             break;
                             case (floatval($notafinal)>='3.0' &&  '3.9'>=floatval($notafinal)):
                                 $color="rgba(255,153,51,1)";
                                 $rangoT="BASICO";
                                 $letra="B";
                             break;
                             case (floatval($notafinal)>='4.0' &&  '4.6'>=floatval($notafinal)):
                                 $color="rgba(255,243,51,1)";
                                 $rangoT="ALTO";
                                 $letra="A";
                             break;
                             case (floatval($notafinal)>'4.6'):
                                 $color="rgba(53,193,4,1)";
                                 $rangoT="SUPERIOR";
                                 $letra="S";
                             break;
                         }
                       
                       DB::insert("INSERT INTO `calificaciones`(`id_periodo`, `id_matricula`, `id_docente`, `id_asignatura`,`nota_inter1`, `nota_inter2`, `nota_inter3`, `nota_inter4`,`nota_arg1`, `nota_arg2`, `nota_arg3`, `nota_prop1`, `nota_prop2`, `nota_prop3`, `nota_soc1`, `nota_soc2`, `nota_soc3`,`nota_auto`, `nota_coe`, `nota_recuperacion`, `nota_definitiva`, `aprobo`, `acumulativo`,`rango`,`letra`,`color`)
                                                    VALUES ($perid,$matricula,$teacher,$course,$nota1,$nota2,$nota3,$nota4,$nota5,$nota6,$nota7,$nota8,$nota9,$nota10,$nota11,$nota12,$nota13,$nota14,$nota15,null,$notafinal,$aprobo,$acomulativo,'$rangoT','$letra','$color') ");
                    }
                    });


                }catch(\PDOException $e) {                        
                    throw new \Exception(json_encode(['error'=>2,'message'=>$e->getMessage()]));
                }               
            });            
        }); 
        $idG=$data['grade'];
        $grado=DB::SELECT("SELECT id_grado  from  grado WHERE grupo='$idG' ");
        $data['gradeId']=$grado[0]->id_grado;
        return json_encode($data);
    }
    public static function drawings($position,$sheet,$height,$widt,$path='/icon.jpg')
    {
        $drawing = new \PHPExcel_Worksheet_Drawing;
        $drawing->setName('Instituto Moderno Desepaz');
        $drawing->setDescription('Software');
        $drawing->setPath(public_path($path));
        $drawing->setCoordinates($position);
        $drawing->setWorksheet($sheet);
        $drawing->setHeight($height);
        $drawing->setWidth($widt);
        return $drawing;
    }
}