<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use Request;

class PeriodoController extends Controller
{
    public function index(){
        return view('periodos.index_periodos');
    }
    public function dt_perido(){
        $periodos=DB::select("SELECT id_periodo,nombre,porcentaje,inicio_periodo,fin_periodo,habilitacion,DATEDIFF(habilitacion,fin_periodo) as dias FROM  periodo");
        $data=[];
         foreach($periodos as $key => $us){                            
             $data['data'][$key]['con']=$key;   
             $data['data'][$key]['id_periodo']=$us->id_periodo;
             $data['data'][$key]['nombre']=$us->nombre;
             $data['data'][$key]['porcentaje']=$us->porcentaje;
             $data['data'][$key]['inicio_periodo']=$us->inicio_periodo;
             $data['data'][$key]['fin_periodo']=$us->fin_periodo;
             $data['data'][$key]['habilitacion']=$us->habilitacion;
             $data['data'][$key]['dias']=  $us->dias;
             $data['data'][$key]['actions']='';
         }
         return json_encode($data);          
     }  
    public function show($id){
       return json_encode(DB::SELECT("SELECT id_periodo,nombre,porcentaje,inicio_periodo,fin_periodo,habilitacion FROM  periodo WHERE id_periodo='$id' ")[0]);
    }
    public function closeTime($id){
        DB::table('periodo')
            ->where('id_periodo',$id)
            ->update(['habilitacion' => NULL]);
        return 1;
    }

    public function edit(){
    $num=Request::input('habilitacion');
    $dateHab=Request::input('hab-date-val');
    $dateFin=(!empty($dateHab))?  $dateHab:null;
    if($num!=""){
        if(!empty(Request::input('hab-date-val') )){
            $dateRetorn = new \DateTime(Request::input('hab-date-val'));            
        }else{
            $dateRetorn = new \DateTime(Request::input('fecha_fin'));            
        }
        $dateFin = $dateRetorn->modify('+' . intval($num) . 'days')->format('Y-m-d');  
    }    
    DB::table('periodo')
            ->where('id_periodo', Request::input('id_periodo'))
            ->update([                    
                    'porcentaje' => intval(Request::input('porcentaje')),
                    'inicio_periodo' =>date('Y-m-d',strtotime(Request::input('fecha_inicio'))) ,
                    'fin_periodo' => date('Y-m-d',strtotime(Request::input('fecha_fin'))),
                    'habilitacion' => $dateFin,
                  ]
          );
    return 1;           
    }
    public function validateTimePeriod($id){
        $date=date('Y-m-d');
        $period=DB::SELECT("SELECT nombre,inicio_periodo,fin_periodo,habilitacion FROM `periodo` WHERE id_periodo='$id' ")[0];
        
        if(!empty($period->habilitacion)){
            if($period->habilitacion >= $date){
                $response=['result'=>true];
            }else{
                $response=['data'=>$period,'result'=>false,'hab'=>true];
            }
        }else{
            if($period->fin_periodo >= $date){
                $response=['result'=>true];
            }else{
                $response=['data'=>$period,'result'=>false];
            }
        }

        
        return json_encode($response);
    }
}