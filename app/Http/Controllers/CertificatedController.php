<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CertificatedController extends Controller
{

    public function indexCertificate(){
        return view('certificate.index_certificate');
    }    
    public function indexConstancia(){
        return view('certificate.index_constancia');
    }
    public function certificatePdf($year,$student,$date,$grade){
        $footerCoor="Esp. Liliana Varela Muñoz";
        $footerDni="CC. 1.118.285.661";
        $footerCar="Rectora";
        $title="CERTIFICADO";
        $GAA="GAA-FR-14";
        $course=DB::SELECT("CALL courseForAlumnLastPeriod('$student','3','$year')");

        //$write=DB::SELECT("CALL sp_averageAndRank('3','$grade')  ");
        //$readTmp=DB::SELECT("SELECT promedio FROM temp_ranking WHERE id_matricula='$student' ");
        
        $readTmp=DB::SELECT("CALL sp_averageAndRank('3','$grade','$student')");
        $periodo=3;
        /*$readTmp=DB::SELECT("DROP TEMPORARY TABLE IF EXISTS temp_ranking;
        SET @numero=0;
        create temporary table IF NOT EXISTS temp_ranking as  
       SELECT  
         @numero:=@numero+1 AS puesto,
         AL.id_alumno,
        AL.identificacion,
        AL.nombre1 ,          
        (select round(AVG(nota_definitiva),2) from calificaciones AS C
        where  C.id_matricula=MT.id_matricula  AND id_periodo='$periodo') AS promedio,
        MT.id  as id_matricula
        from matricula AS MT 
        INNER JOIN grado as G on MT.id_grado=G.id_grado
        INNER JOIN alumno AS AL on MT.id_alumno=AL.id_alumno
        where G.id_grado='$grade'   AND  MT.año=YEAR(CURDATE())
        ORDER BY (select round(AVG(nota_definitiva),2) from calificaciones AS C where  C.id_matricula=MT.id_matricula  AND id_periodo='$periodo')  DESC;        
        SELECT puesto,promedio FROM temp_ranking WHERE id_matricula='$student';
        ");  */
        $aprobo=($readTmp[0]->promedio >= 3.0)? 1:0;

        $student=DB::SELECT("CALL sp_infoStudent('$student')  ");
        $firstName=empty($student[0]->nombre1)? '':$student[0]->nombre1;
        $secondName=empty($student[0]->nombre2)? '':$student[0]->nombre2;
        $surname=empty($student[0]->apellido1)? '':$student[0]->apellido1;
        $secondSurname=empty($student[0]->apellido2)? '':$student[0]->apellido2;
        $fullname=$firstName.' '.$secondName .' '. $surname. '  '. $secondSurname;        
        $pdf = \PDF::loadView('certificate.pdf_certificate',compact('footerCoor','footerDni','footerCar','title','date','course','GAA','year','aprobo','fullname','student'))->setPaper('letter')->stream($GAA.".pdf");
        return $pdf;
    }
    public function constanciaPdf($matricula,$date){
        $footerCoor="Esp. Liliana Varela Muñoz";
        $footerDni="CC. 1.118.285.661";
        $footerCar="Rectora";
        $title="CONSTANCIA";
        $GAA="GAA-FR-15";        
        $student=DB::SELECT("CALL sp_infoStudent('$matricula')  ");
        $firstName=empty($student[0]->nombre1)? '':$student[0]->nombre1;
        $secondName=empty($student[0]->nombre2)? '':$student[0]->nombre2;
        $surname=empty($student[0]->apellido1)? '':$student[0]->apellido1;
        $secondSurname=empty($student[0]->apellido2)? '':$student[0]->apellido2;
        $fullname=$firstName.' '.$secondName .' '. $surname. '  '. $secondSurname;
        $pdf = \PDF::loadView('certificate.pdf_constancia',compact('footerCoor','footerDni','footerCar','title','GAA','student','fullname','date'))->setPaper('letter')->stream($GAA.".pdf");
        return $pdf;
    }
    public function indexPdfMatricula(){ /** Constancia */
        $title="FICHA DE MATRICULA No.";
        $GAA="GAA-FR-05";        
        $pdf = \PDF::loadView('certificate.pdf_constancia',compact('footerCoor','footerDni','footerCar','title'))->setPaper('letter')->stream($GAA.".pdf");
        return $pdf;
    } 
    
    public function studentsForGradeYear($grado,$year){
        return json_encode(DB::SELECT("CALL studentsForGrades('$grado', '$year') "));
    }
    
}
