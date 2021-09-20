<?php
namespace App\Http\Controllers;
use DB;
use App\User;
use Request;
use App\Model\alumno;
use App\Model\matricula;
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
                               
                            $alum= new alumno();
                            $alum->id_tipo_doc= Request::input('tipo_doc');
                            $alum->identificacion=Request::input('dni');                    
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
                            
                            // validacion de estuduantes que no esten en BD 
                            // validaion de matricula para el mismo año 
                            // ajustar vista  nombres 
                                         
                });                            
                } catch (Exception $th) {                
                    return response()->json(['message'=>'Error en la base de datos','error' => $th->getMessage()],400);              
                }
   


    }
}
