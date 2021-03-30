<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Model\matricula;
use App\Model\alumno;
use App\Model\acudiente;
use App\Model\grado;
use DB;

class BoletinController extends Controller
{
    
    public function index(){
        return view('boletin.index_boletin');
    }
    public function genetedBulletin(){

        return $pdf = \PDF::loadView('boletin.pdf_boletin')->stream('archivo.pdf');       
       //$pdf->setPaper('letter', 'landscape');
       // return $pdf->download();       
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

    public function loadExcelEnrollment(){

    \Excel::load('public\matriculas.xlsx', function($reader) {        
        $data=[];      
        $i=0;   
        $reader->each(function($row){            

            
                try {
                    DB::transaction(function() use($row){

                       // dd($row->grupo_grado);
                            if(!empty($row->tipo_docestu)){
                                $modalidaId=3;
                                if (!empty($row->modalidad_sena)) {
                                    $modalidad=DB::SELECT("select id_modalidad_sena as id from  modalidad_sena where  tag LIKE '%$row->modalidad_sena%' ");
                                    $modalidaId=$modalidad[0]->id;
                                }
                                $grados=DB::SELECT("select id_grado as id from  grado where grupo='$row->grupo_grado' ");                               
                                $id_grado=isset($grados[0]->id)? $grados[0]->id:27;
                                
                   
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
                                $alum->id_tipo_eps=isset($row->codigo_eps)? $row->codigo_eps:25; /** colocar id  */
                    
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
                                $mat->grado_cursar=strval($row->gradoCursa);
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
    
    
                                $acudiente=DB::SELECT("select id_acudiente as id from acudiente  where identificacion='$row->cc' ");
                                
                                // validar si viene array o objeto
                                //$id_acudiente='';
                               if(empty($acudiente) &&  !empty($row->acudientenombre)  ){
                                    $ac=new acudiente();
                                    $ac->nombre=$row->acudientenombre;
                                    $ac->identificacion=$row->cc;
                                    $ac->expedida =$row->expedida;
                                    $ac->id_tipo_parentesco =   $row->codigo_parentesco;   /** colocar id parentesco */
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
                               DB::SELECT("INSERT INTO alumno_acudiente ('id_alumno', 'id_acudiente') VALUES ('$alum->id','$id_acudiente') "); /** acudiente */
                    
                                
                                
                    
                                
                                if(!empty($row->ccpadre)  && !empty($row->nombrepadre) ){
                                    $acudientePadre=DB::SELECT("select id_acudiente as id from acudiente  where identificacion='$row->ccpadre' ");
                                    if(empty($acudientePadre)){
                        
                                        $padre=new acudiente();
                                        $padre->nombre=$row->nombrepadre;
                                        $padre->identificacion=$row->ccpadre;
                                        $padre->expedida=$row->expedidapadre;
                                        $padre->id_tipo_parentesco =15; 
                                        $padre->direccion=$row->direccionpadre;
                                        $padre->barrio_id=$row->barriopadre;
                                        $padre->telefono=$row->telefonopadre;
                                        $padre->profesion=$row->profesionpadre;
                                        $padre->empresa=$row->empresapadre;
                                        $padre->updated_at=date('Y-m-d');
                                        $padre->save();
                                        $id_padre=$padre->id;
                                    }else{
                                        $id_padre=$acudientePadre[0]->id;
                                    }
                                    DB::SELECT("INSERT INTO alumno_acudiente ('id_alumno', 'id_acudiente') VALUES ( '$alum->id','$id_padre') "); /** padre */    
                                }
                    
                                
                                if(!empty($row->nombremadre)){
                    
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
                                    DB::SELECT("INSERT INTO alumno_acudiente ('id_alumno', 'id_acudiente') VALUES ( '$alum->id','$id_madre') "); /** madre */
                                }
                    
    
                           }
                            

                           

                        
                    });
                            
                    } catch (Exception $th) {                
                        return response()->json(['message'=>'Error en la base de datos','error' => $th->getMessage()],400);              
                    }



            
        


            

        });                                 
    })->get();
}


public function readEnrollmentQualification(){
    \Excel::load('public\excel.xlsx', function($reader) {
        //$reader->skipRows(9); omitir   filas  
        $data=[];         
        $reader->each(function($row){              
        });
    });
}

    public function generatedEnrollmentQualification($idTeacher,$grade){

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
