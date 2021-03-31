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

    public function generatedEnrollmentQualification(){


       /* $grade = \Request::input('grade');
        $period = \Request::input('perid');
        $alumnoGrade=DB::SELECT("SELECT B.id_matricula,A.nombre1,A.nombre2,A.apellido1,A.apellido2,C.grupo FROM alumno AS A
                            INNER JOIN matricula AS B ON A.id_alumno=B.id_alumno
                            INNER JOIN grado AS C ON  B.id_grado=C.id_grado
                            WHERE B.id_estado_matricula=1 AND B.id_grado='$grade' ");*/


        $idTeacher=\Request::input('idTeacher');
        $grade=\Request::input('grade');

        \Excel::create('Grado-'.$grade, function($excel) use($idTeacher,$grade) {  

            $excel->sheet($grade, function($sheet) use($idTeacher,$grade) {
                $sheet->setStyle(array('font'=>array('name'=>'Arial','size'=>11)));
                self::drawings('B1',$sheet,90,110); 


                $styleArray = array( 'font' => array( 'bold' => true ) );  /** Negrita */
                $styleTitle = array('alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER), 'font' => array( 'bold' => true )); /** Titulo */
                $styleCenter=array('alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER)); 
              
               $sheet->setCellValue('A2','INSTITUTO MODERNO DESEPAZ');
               $sheet->setCellValue('A3','Resolución No 4143.010.21.9981 del 18 de Diciembre de 2017 de la Secretaría de Educación.');
               $sheet->setCellValue('A4','PLANILLA DE EVALUACIÓN');
               $sheet->setCellValue('A5','PROFESOR: LILIA DEL SOCORRO IBARGUEN');
               $sheet->setCellValue('A6','GRADO: '.$grade);
               $sheet->setCellValue('A7','ASIGNATURA: '.'MATEMATICAS');

              
                

                
                $letter=0;                
                $acb=['A','B','C', 'D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];


                $sheet->setCellValue('F9','Cognitivo');
                $sheet->mergeCells('F9:'.$acb[7].'9');
                $sheet->getStyle('F9')->applyFromArray($styleTitle);

                $sheet->setCellValue('I9','Social');
                $sheet->mergeCells('I9:'.$acb[10].'9');
                $sheet->getStyle('I9')->applyFromArray($styleTitle);

                
                $sheet->setCellValue('L9','Personal');
                $sheet->mergeCells('L9:'.$acb[13].'9');
                $sheet->getStyle('L9')->applyFromArray($styleTitle);

                $title=['Matricula','Estudiante','Grado','Asignatura','Periodo','c1','c2','c3','s1','s2','s3','p1','p2','p3','Autoe','Def'];
                for($x=0;$x<count($title);$x++){                                                           
                    $sheet->getStyle($acb[$letter].'10')->applyFromArray($styleArray);
                    $sheet->setCellValueByColumnAndRow($x,10,$title[$x]);                      
                    ++$letter;
                }

                $sheet->mergeCells('A2:'.$acb[$letter-1].'2');
                $sheet->mergeCells('A3:'.$acb[$letter-1].'3');
                $sheet->mergeCells('A4:'.$acb[$letter-1].'4');
                $sheet->mergeCells('A5:'.$acb[$letter-1].'5');
                $sheet->mergeCells('A6:'.$acb[$letter-1].'6');
                $sheet->mergeCells('A7:'.$acb[$letter-1].'7');
                $sheet->getStyle('A2:'.$acb[$letter-1].'2')->applyFromArray($styleTitle);
             

                //$sheet->setBorder("A10:Q11",'thin');
                /*$sheet->cell('A10:Q11', function($cell){
                    $cell->setBorder('thin','thin','thin','thin');
                });*/                   
               // $sheet->setBorder('A10:Q10','thin');    
                $sheet->cells('A1:'.$acb[$letter-1].'7', function ($cells) {
                    $cells->setBackground('#FFFDFD');
                    $cells->setAlignment('center');                    
                    $cells->setBorder('thin','thin','thin','thin');                    
                });


                $row=0;
                $alu=11;
                //   $sheet->setBorder('A10:'.$acb[$key].$key, 'thin');
                
                foreach($title as $key=> $alumno){
                    $sheet->setCellValueByColumnAndRow($row,$alu,$alu);  
                    $sheet->setCellValueByColumnAndRow($row+1,$alu,113);  
                    $sheet->setCellValueByColumnAndRow($row+2,$alu,$alumno);                   



                    $sheet->cells('A10:'.$acb[$letter-1].'10', function ($cells) {
                        $cells->setBackground('#FFFDFD');
                        $cells->setAlignment('center');                    
                        $cells->setBorder('thin','thin','thin','thin');                    
                    });
                    ++$alu;
                }
            });

        })->export('xls');    
    }

    public static function drawings($position,$sheet,$height,$widt,$path='/icon.jpg')
    {
        $drawing = new \PHPExcel_Worksheet_Drawing;
        $drawing->setName('Instituto Moderno');
        $drawing->setDescription('Software');
        $drawing->setPath(public_path($path));
        $drawing->setCoordinates($position);
        $drawing->setWorksheet($sheet);
        $drawing->setHeight($height);
        $drawing->setWidth($widt);
        return $drawing;
    }

    

}
