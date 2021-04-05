<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
class CalificacionesController extends Controller
{
    public function index(){        
        return view('calificaciones.index_calificaciones');
    }
    public function alumnCourse(){

    $grade = \Request::input('grade');
    $period = \Request::input('perid');

    $alumnoGrade=DB::SELECT("SELECT B.id_matricula,A.nombre1,A.nombre2,A.apellido1,A.apellido2,C.grupo FROM alumno AS A
                            INNER JOIN matricula AS B ON A.id_alumno=B.id_alumno
                            INNER JOIN grado AS C ON  B.id_grado=C.id_grado
                            WHERE B.id_estado_matricula=1 AND B.id_grado='$grade' ");                            
        $data=[]; $i=1;
        foreach($alumnoGrade as $key => $row){
            $data['data'][$key]['conc'] = $i;
            $data['data'][$key]['mat'] = $row->id_matricula;
            $data['data'][$key]['alumn'] = $row->nombre1.' '.$row->nombre2.' '.$row->apellido1. ' '.$row->apellido1;
            $data['data'][$key]['grupo']=$row->grupo;
            $data['data'][$key]['period1']=(1==$period)? 'X':'';
            $data['data'][$key]['period2']=(2==$period)? 'X':'';
            $data['data'][$key]['period3']=(3==$period)? 'X':'';
            $data['data'][$key]['notas']='';
            ++$i;
        }
        return $data;
    }

    public function generatedEnrollmentQualification($grade,$teacher,$period,$course){
                                        /*      -- COLOCAR MODULA ESTUDIANTES CALIFICADOS POR PERIODO 
                                        SELECT  B.id_matricula,CONCAT(A.nombre1,'-',A.nombre2,'-',A.apellido1,'-',A.apellido2) AS estudiante ,D.nombre,C.nota_cog1,C.nota_cog2,C.nota_cog3,C.nota_cog4 from calificaciones as C
                                        RIGHT JOIN matricula AS B ON C.id_matricula=B.id_matricula
                                        INNER JOIN alumno as A ON  B.id_alumno=A.id_alumno
                                        INNER JOIN grado AS D ON  B.id_grado=D.id_grado
                                        WHERE B.id_estado_matricula=1 AND B.id_grado=11 
                                        AND C.id_periodo=1 AND id_asignatura=1
                                        */
        $alumnoGrade=DB::SELECT("SELECT B.id_matricula,A.nombre1,A.nombre2,A.apellido1,A.apellido2,C.grupo FROM alumno AS A
                            INNER JOIN matricula AS B ON A.id_alumno=B.id_alumno
                            INNER JOIN grado AS C ON  B.id_grado=C.id_grado
                            WHERE B.id_estado_matricula=1 AND B.id_grado='$grade' ");

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

                $sheet->setCellValue('G11','Cognitivo');
                $sheet->mergeCells('G11:J12');
                $sheet->getStyle('G11')->applyFromArray($styleTitle);
                            
                $sheet->setCellValue('K11','Social');
                $sheet->mergeCells('K11:M12');
                $sheet->getStyle('K11')->applyFromArray($styleTitle);
                
                $sheet->setCellValue('N11','Personal');
                $sheet->mergeCells('N11:P12');
                $sheet->getStyle('N11')->applyFromArray($styleTitle);

                $sheet->setCellValue('Q11','AutoE');
                $sheet->mergeCells('Q11:R12');
                $sheet->getStyle('Q11')->applyFromArray($styleTitle);
             $title=['Matricula','Estudiante','1','2','3','4','c1','c2','c3','c4','s1','s2','s3','p1','p2','p3','Au1','Au2','Def'];
             
                for($x=0;$x<count($title);$x++){                                                           
                    $sheet->getStyle($acb[$letter].'13')->applyFromArray($styleArray);
                    $sheet->setCellValueByColumnAndRow($x,13,$title[$x]);                      
                    $sheet->setCellValueByColumnAndRow($x,1,$title[$x]);                      
                    ++$letter;
                }
                $sheet->getStyle('A1:S1')->applyFromArray( [
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
                    $name=$alumno->nombre1.'  '. $alumno->nombre2.'  '.$alumno->apellido1.'  '.$alumno->apellido2;
                    $sheet->setCellValueByColumnAndRow($row+1,$alu,$name);
                    
                    ++$alu;
                }
                $sheet->setBorder('A13:T'.($alu-1), 'thin');

                $sheet->cells('A11:S13', function ($cells) {
                    $cells->setBackground('#E1D9D9');
                    $cells->setAlignment('center');
                    $cells->setBorder('thin','thin','thin','thin');
                });
                $sheet->setFreeze('A14');
                $sheet->protect('123456');
                $sheet->getStyle('G14:R100')->getProtection()->setLocked(\PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);                                
            });

        })->download('xls');    
    }

    
    public function readEnrollmentQualification(){
        \Excel::load('public\notas.xls', function($reader) {
        $sheet = $reader->getSheet(0); 
        //$grado=$sheet->getCell('A11')->getValue(); 
        $course=substr($sheet->getCell('A12')->getValue(),13,strlen($sheet->getCell('A12')->getValue())); 
        $perid=intval(substr($sheet->getCell('A5')->getValue(),9,strlen($sheet->getCell('A5')->getValue()))); 
        $teacher=substr($sheet->getCell('A6')->getValue(),10,strlen($sheet->getCell('A6')->getValue()));
        $reader->ignoreEmpty();
        $reader->takeColumns(19);        
        $singleRow =$reader->skipRows(12)->get(); 
        
        $users=DB::SELECT("SELECT id  from  users WHERE name='$teacher' ");
        $curso=DB::SELECT("SELECT id_asignatura  from  asignatura WHERE nombre='$course' ");
        $data=[];    
        $data=['period'=>$perid,'teacher'=>$users[0]->id,'course'=>$curso[0]->id_asignatura];    


        $reader->each(function($row) use ($data){  
            
            //dd(floatval($row->c4));
            dd($row);
                DB::beginTransaction();
                try {       

                   $perid=$data['period'];
                   $matricula=intval($row->matricula); 
                   $teacher=$data['teacher'];
                   $course=$data['course'];


                   $nota1=floatval($row->c1);
                   $nota2=floatval($row->c2);
                   $nota3=floatval($row->c3);
                   $nota4=floatval($row->c4);
                   $nota5=floatval($row->s1);
                   $nota6=floatval($row->s2);
                   $nota7=floatval($row->s3);
                   $nota8=floatval($row->p1);
                   $nota9=floatval($row->p2);
                   $nota10=floatval($row->p3);
                   $nota11=floatval($row->Au1);
                   $nota12=floatval($row->Au2);

                   //revisar si  viene con punto o coma
                   //validar si no viene vacio

                   $notafinal=($nota1+$nota2+$nota3+$nota4+$nota5+$nota6+$nota7+$nota8+$nota9+$nota10+$nota11+$nota11+$nota12)/12;

                   $acomulativo=($notafinal*33/100);




                    
                  DB::insert("INSERT INTO `calificaciones`(`id_periodo`, `id_matricula`, `id_docente`, `id_asignatura`, `nota_cog1`, `nota_cog2`, `nota_cog3`, `nota_cog4`, `nota_soc1`, `nota_soc2`, `nota_soc3`, `nota_per1`, `nota_per2`, `nota_per3`, `nota_auto`, `nota_coe`, `nota_recuperacion`, `nota_definitiva`, `aprobo`, `acumulativo`, `notas_adicionales_id_nota`, `created_at`, `updated_at`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19],[value-20],[value-21],[value-22],[value-23],[value-24])");} catch (\Throwable $th) {                    
                  DB::commit();
                }catch (\Exception $e) {
                    DB::rollback();
                    throw new Exception(json_encode($e->getMessage()));
                }                
            });
        });
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
