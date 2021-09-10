<?php
namespace App\Http\Controllers;
use DB;
use App\User;
use Request;

class MatriculasController extends Controller
{
    public function index(){
        return view('matricula.index_matricula');
    }
    public function index_create(){
        return view('matricula.index_created');
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
             $data['data'][$key]['actions']='';
         }
         return json_encode($data);          
    }
    public function pdfEnrollment(){ 
        $title="FICHA DE INSCRIPCIÓN";
        $GAA="GAA-FR-02";
        $pdf = \PDF::loadView('matricula.pdf_matricula',compact('footerCoor','footerDni','footerCar','title','GAA'))->setPaper('letter')->stream($GAA.".pdf");
        return $pdf;
    }
    public function searchStudent($dni){

        $year=date('Y-m-d');
        $consul=DB::SELECT("SELECT alumno. FROM matricula
        inner join alumno on matricula.id_alumno=alumno.id_alumno
        where alumno.identificacion='$dni' AND matricula.año='$year' ");

        return count($consul[0]);

    }
    public function registerEnrollment(){ 

        $barrios=DB::SELECT("SELECT * FROM barrio");
        $grupoEt=DB::SELECT("SELECT * FROM grupo_etnico");
        return view('matricula.index_enrollment_out',compact('barrios','grupoEt'));
    }
    public function storeEnrollement(){

    try {
        DB::transaction(function(){
                        

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
                                         
                });                            
                } catch (Exception $th) {                
                    return response()->json(['message'=>'Error en la base de datos','error' => $th->getMessage()],400);              
                }
   


    }
}
