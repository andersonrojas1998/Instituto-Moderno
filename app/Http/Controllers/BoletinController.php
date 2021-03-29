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

    \Excel::load('public\excel.xlsx', function($reader) {        
        $data=[];         
        $reader->each(function($row){            


        try {
        DB::transaction(function(){
            $modalidaId='';
            if (!empty($row->MODALIDAD_SENA)) {
                $modalidad=DB::SELECT("select id_modalidad_sena as id from  modalidad_sena where  tag LIKE '%$row->MODALIDAD_SENA%' ");
                $modalidaId=$modalidad->id;
            }
            
            $grados=DB::SELECT("select id_grado as id from  grado where grupo= '$row->grupo_grado' ");
            $id_grado=$grados->id;
            

            $mat=new matricula();
            $mat->simat=$row->SIMAT;
            $mat->victima_conflicto=$row->POBLACION_VICTIMA_DEL_CONFLICTO;
            $mat->id_modalidad_sena=$modalidaId;
            $mat->grupo_simat=$row->GRUPO_SIMAT;
            $mat->grado_cursar=$row->GRADO;
            $mat->id_grado=$id_grado;     
            $mat->subsidiado=$row->SUBSIDIADO;  
            $mat->tipo_discapacidad=$row->tipo_discapacidad;
            $id_tp_matricula=3;
            if($row->REPITENTE=="SI"){
                $id_tp_matricula=2;
            }elseif ($row->NUEVO) {
                $id_tp_matricula=1;
            }                        
            $mat->id_tipo_matricula=$id_tp_matricula;            
            $mat->inst_anterior=$row->INSTITUCION_ANTERIOR;
            $mat->ciudad_colegio_origen=$row->ciudad_colegio_origen;
            $mat->save();

            

            
            $acudiente=DB::SELECT("select id_acudiente as id from acudiente  where identificacion='$row->CC' ");
            // validar si viene array o objeto
            if(empty($acudiente)){
                $ac=new acudiente();
                $ac->nombre=$row->ACUDIENTENOMBRE;
                $ac->identificacion=$row->CC;
                $ac->expedida =$row->EXPEDIDA;
                $ac->id_tipo_parentesco =   $row->PARENTESCO;   /** colocar id parentesco */
                $ac->direccion=$row->DIRECCIONACUDI;
                $ac->barrio_id=$row->BARRIOACUD;/**  colocar id */
                $ac->telefono=$row->TELEFONOACUDIENTE;
                $ac->responsable=1;
                $ac->save();
                $id_acudiente=$ac->id;
            }else{
                $id_acudiente=$acudiente[0]->id;
            }

            
            

            $alum= new alumno();
            $alum->id_tipo_doc=$row->TIPO_DOCUMENTO;
            $alum->identificacion=$row->DOCUMENTO;

            $alum->lugar_expedicion=$row->EXP_MUN;
            $alum->apellido1  =$row->APELLIDO1;
            $alum->apellido2 =$row->APELLIDO2;
            $alum->nombre1 =$row->NOMBRE1;
            $alum->nombre2 =$row->NOMBRE2;
            $alum->direccion =$row->DIRECCION_RESIDENCIA;
            $alum->telefono	 =$row->TELEFONO;
            $alum->id_barrio= $row->codigo_barrio; // colocar id
            $alum->id_departamento =1;
            $alum->id_municipio=1;
            $alum->id_tipo_eps=$row->SEGURO; /** colocar id  */

            $alum->fecha_nacimiento=date('Y-m-d',strtotime($row->FECHA_NAC));

            $alum->nac_muni=$row->nac_mun;
            $alum->nac_depto=$row->NAC_DEPTO;

            $alum->genero=($row->GENERO=="MASCULINO")? 'M':'F';
            $alum->save();

            
            DB::SELECT("INSERT INTO alumno_acudiente ('id_alumno', 'id_acudiente') VALUES ( '$alum->id','$id_acudiente') "); /** acudiente */

            
            if(!empty($row->CCPADRE)){
                $acudientePadre=DB::SELECT("select id_acudiente as id from acudiente  where identificacion='$row->CCPADRE' ");
                if(empty($acudientePadre)){
    
                    $padre=new acudiente();
                    $padre->nombre=$row->NOMBREPADRE;
                    $padre->identificacion=$row->CCPADRE;
                    $padre->expedida=$row->EXPEDIDAPADRE;
                    $padre->id_tipo_parentesco =15; 
                    $padre->direccion=$row->DIRECCIONPADRE;
                    $padre->barrio_id=$row->BARRIOPADRE;
                    $padre->telefono=$row->TELEFONOPADRE;
                    $padre->profesion=$row->PROFESIONPADRE;
                    $padre->empresa=$row->EMPRESAPADRE;
                    $padre->save();
                    $id_padre=$padre->id;
                }else{
                    $id_padre=$acudientePadre[0]->id;
                }
                DB::SELECT("INSERT INTO alumno_acudiente ('id_alumno', 'id_acudiente') VALUES ( '$alum->id','$id_padre') "); /** padre */    
            }

            
            if(!empty($row->NOMBREMADRE)){

                $acudienteMadre=DB::SELECT("select id_acudiente as id from acudiente  where identificacion='$row->CCMADRE' ");

                if(empty($acudienteMadre)){

                    $madre=new acudiente();
                    $madre->nombre=$row->NOMBREMADRE;
                    $madre->identificacion= $row->CCMADRE;
                    $madre->expedida=$row->EXPEDIDAMADRE;
                    $madre->id_tipo_parentesco =9;
                    $madre->direccion=$row->DIRECCIONMADRE;
                    $madre->barrio_id=$row->BARRIOMADRE; /** */
                    $madre->telefono=$row->TELEFONOMADRE;
                    $madre->profesion=$row->PROFESIONMADRE;
                    $madre->empresa=$row->EMPRESAMADRE;
                    $id_madre=$madre->id;
                }else{
                    $id_madre=$acudienteMadre[0]->id;                    
                }
                DB::SELECT("INSERT INTO alumno_acudiente ('id_alumno', 'id_acudiente') VALUES ( '$alum->id','$id_madre') "); /** madre */
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

            $excel->sheet($grade, function($sheet) use($idTeacher) {
                $sheet->setStyle(array('font'=>array('name'=>'Arial','size'=>11)));
                self::drawings('B1',$sheet,120,120); 


                $styleArray = array( 'font' => array( 'bold' => true ) );  /** Negrita */
                $styleTitle = array('alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER), 'font' => array( 'bold' => true )); /** Titulo */
               
              /*  $sheet->getStyle('C2')->applyFromArray($styleArray); */ 
               $sheet->setCellValue('A2','INSTITUTO MODERNO DESEPAZ');
               $sheet->setCellValue('A3','Resolución No 4143.010.21.9981 del 18 de Diciembre de 2017 de la Secretaría de Educación.');
               /*$sheet->setCellValue('A4','PLANILLA DE EVALUACIÓN');
               $sheet->setCellValue('A5','PROFESOR: LILIA DEL SOCORRO IBARGUEN');	*/									

              
                

                $row=0;
                $letter='A';
                //GRADO,ASIGNATURA,DOCENTE


                $title=['Matricula','Estudiante','Grado','Asignatura','Periodo','Cog1','Cog2','Cog3','Soc1','Soc2','Soc3','Per1','Per2','Per3','Auto','Coe'];
                for($x=0;$x<=15;$x++){

                    
                   
                    
                   $sheet->getStyle($letter.'10')->applyFromArray($styleArray);
                    $sheet->setCellValueByColumnAndRow($x,10,$title[$x]); 
                    $sheet->setBorder('A10:O10', 'thin');           // .$letter. '10'
                    ++$letter;
                }

                $sheet->mergeCells('A2:'.$letter.'2');
                $sheet->mergeCells('A3:'.$letter.'3');
                $sheet->getStyle('A2:'.$letter.'2')->applyFromArray($styleTitle);

                $alu=11;
                foreach($title as $key=> $alumno){
                    $sheet->setCellValueByColumnAndRow($row,$alu,$alu);  
                    $sheet->setCellValueByColumnAndRow($row+1,$alu,113);  
                    $sheet->setCellValueByColumnAndRow($row+2,$alu,$alumno);  
                    ++$alu;
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
