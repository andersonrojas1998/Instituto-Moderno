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
    
    
                                
                                
                                // validar si viene array o objeto
                                //$id_acudiente='';
                               
                               
                    
                                
                                
                    
                                
                                
                    
                                
                                
                    
    
                           }
                            

                           

                        
                    });
                            
                    } catch (Exception $th) {                
                        return response()->json(['message'=>'Error en la base de datos','error' => $th->getMessage()],400);              
                    }

        });                                 
    })->get();
}
}