<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoletinController extends Controller
{
    
    public function index(){
        return view('boletin.index_boletin');
    }
    public function genetedBulletin(){

        return $pdf = \PDF::loadView('boletin.pdf_boletin')->stream('archivo.pdf');       
       //$pdf->setPaper('letter', 'landscape');
        //    return $pdf->download();        

    }


    public function loadExcelEnrollment(){

        \Excel::load('public\excel.xlsx', function($reader) {
            //$reader->skipRows(9); omitir   filas  
            $data=[];         
            $reader->each(function($row){
                $data['curso']=$row->curso;
                $data['apellidos']=$row->apellidos;
                $data['asignatura']=$row->asignatura;
                $data['cognitivo_30']=$row->cognitivo_30;
                dd($data);

            });                                 
        })->get();
    }
    public function generatedEnrollmentQualification($idTeacher,$grade){

        \Excel::create('Grado-'.$grade, function($excel) use($idTeacher,$grade) {  

            $excel->sheet($grade, function($sheet) use($idTeacher) {

                $sheet->setStyle(array('font'=>array('name'=>'Arial','size'=>11)));
                self::drawings('B1',$sheet,120,120); 


                $styleArray = array( 'font' => array( 'bold' => true ) );  /** Negrita */
               // $sheet->getStyle('B13')->applyFromArray($styleArray);  
                //$sheet->setCellValue('B13','Anderson Rojas Capera');
                

               // $row=0;
                $letter='A';
                //GRADO,ASIGNATURA,DOCENTE


                $title=['Matricula','Estudiante','Grado','Asignatura','Periodo','Cog1','Cog2','Cog3','Soc1','Soc2','Soc3','Per1','Per2','Per3','Auto','Coe'];
                for($x=0;$x<15;$x++){
                    
                   $sheet->getStyle($letter.'10')->applyFromArray($styleArray);
                    $sheet->setCellValueByColumnAndRow($x,10,$title[$x]); 
                    $sheet->setBorder('A10:'.$letter. '10', 'thin');            
                    ++$letter;
                }
               /* $sheet->setCellValueByColumnAndRow($row,9,'Matricula');   
                $sheet->setCellValueByColumnAndRow($row+1,9,'Estudiante');   
                $sheet->setCellValueByColumnAndRow($row+2,9,'Grado');
                $sheet->setCellValueByColumnAndRow($row+3,9,'Asignatura');
                $sheet->setCellValueByColumnAndRow($row+4,9,'Periodo');
                $sheet->setCellValueByColumnAndRow($row+5,9,'Cog1');
                $sheet->setCellValueByColumnAndRow($row+6,9,'Cog2');
                $sheet->setCellValueByColumnAndRow($row+7,9,'Cog3');
                $sheet->setCellValueByColumnAndRow($row+8,9,'Soc1');
                $sheet->setCellValueByColumnAndRow($row+9,9,'Soc2');
                $sheet->setCellValueByColumnAndRow($row+10,9,'Soc3');


                $sheet->setCellValueByColumnAndRow($row+11,9,'Per1');
                $sheet->setCellValueByColumnAndRow($row+12,9,'Per2');
                $sheet->setCellValueByColumnAndRow($row+13,9,'Per3');

                $sheet->setCellValueByColumnAndRow($row+14,9,'Auto');
                $sheet->setCellValueByColumnAndRow($row+15,9,'Coe');*/
            });

        })->export('xls');;

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
