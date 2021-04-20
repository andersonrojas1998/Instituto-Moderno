<?php
namespace App\Http\Controllers;
use Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Model\Homecare_Paciente_Cuidador;
use App\Model\Paciente;
use DateTime;
use DB;
use function GuzzleHttp\json_encode;
use App\Model\General_Perfil;
use App\Model\General_Cuidador_Obsanulation;
use App\Model\Homecare_tipo_cuidador;
use App\Model\Homecare_Cuidador_Seguimiento;


class CaregiversController extends Controller
{
  
  public function __construct(){
    $this->middleware('auth');
  }
  public function index(){
  }
   public function indexInicio(){
    return view('caregivers.index');
  }
  public function indexCarer(){
    return view('caregivers.indexCarer');
  }

  public function loadPreOrden(){
    return view('caregivers.loadPreOrden');
  }
  public function indexReport(){
    return view('caregivers.reports.index');
  }

public function PatientCaregivers(){
  $pcte = Request::input('pcte');
  $desde = Request::input('desde');
  $hasta = Request::input('hasta');
  $turns = Homecare_Paciente_Cuidador::where('id_paciente',$pcte)->where('fecha_inicia','>=',$desde)->where('fecha_fin','<=',$hasta)->get();
  $i=0;
  foreach ($turns as $key => $value) {
          $data['data'][$i]['id'] = $value->id;
          $data['data'][$i]['paciente'] = $value->user->name;
          $data['data'][$i]['desde'] = $value->fecha_inicia;
          $data['data'][$i]['hasta'] = $value->fecha_fin;
          $data['data'][$i]['observacion'] = $value->observacion;
          $data['data'][$i]['status'] = ($value->status == 1) ? '<span class="label label-success pull-right">Activo</span>' : '<span class="label label-danger pull-right">Anulado</span>';
          
          if($value->seguimiento_administrativo){
            switch ($value->seguimiento_administrativo->id_status) {
              case 1:
                $data['data'][$i]['seg_status'] =' <span class="label label-success pull-right">Asistio</span>';
               
                break;
              case 2:
                $data['data'][$i]['seg_status'] = '<span class="label label-warning pull-right">Asistio Parcialmente</span>';
                
                break;
                case 3:
                $data['data'][$i]['seg_status'] = '<span class="label label-danger pull-right">No Asistio</span>';
                
                break;
              
            }
            $data['data'][$i]['hra_ini'] = $value->seguimiento_administrativo->hora_inicio;
            $data['data'][$i]['hra_fin'] = $value->seguimiento_administrativo->hora_fin;
            $data['data'][$i]['seg_status_obs'] = $value->seguimiento_administrativo->descripcion;
          }else{
                $data['data'][$i]['seg_status'] ='<span class="label label-primary pull-right">Sin seguimiento</span>';
                $data['data'][$i]['seg_status_obs'] = 'No data';
                $data['data'][$i]['hra_ini'] = 'No data';
                $data['data'][$i]['hra_fin'] = 'No data';
            }

           if($value->supportStatus == 1) 
            $data['data'][$i]['action'] = '<small class="label pull-right bg-green"><i class="fa fa-fw fa-check-square"></i></small>' ;
            else
            $data['data'][$i]['action'] = '<small class="label pull-right bg-red"><i class="fa fa-fw fa-close"></i></small>';
          $i++;
    }
    return json_encode($data);
}

  public function caregiverTurnsValidate(){

    try{
      $turns = Request::input('arry');
    foreach ($turns as $key => $value) {
      
      $turn = Homecare_paciente_cuidador::find($value['id']);
      $turn->supportStatus = 1 ;
      $turn->save();
    }
    return 1;
    } catch(Exception $e){
        return 0;
    }

    
  }

  public function caregiverTurns(){
    $user = Request::input('user');
    $desde = Request::input('desde');
    $hasta = Request::input('hasta');

      $data = [];
      $i=0;
    $turns = Homecare_paciente_cuidador::where('id_profesional',$user)->where('fecha_inicia','>=',$desde)->where('fecha_fin','<=',$hasta)->where('supportStatus','<>',1)->get();
    foreach ($turns as $key => $value) {
          $data['data'][$i]['id'] = $value->id;
          $data['data'][$i]['paciente'] = $value->patient->name;
          $data['data'][$i]['desde'] = $value->fecha_inicia;
          $data['data'][$i]['hasta'] = $value->fecha_fin;
          $data['data'][$i]['observacion'] = $value->observacion;
          $data['data'][$i]['status'] = ($value->status == 1) ? '<span class="label label-success pull-right">Activo</span>' : '<span class="label label-danger pull-right">Anulado</span>';
          
          if($value->seguimiento_administrativo){
            switch ($value->seguimiento_administrativo->id_status) {
              case 1:
                $data['data'][$i]['seg_status'] =' <span class="label label-success pull-right">Asistio</span>';
               
                break;
              case 2:
                $data['data'][$i]['seg_status'] = '<span class="label label-warning pull-right">Asistio Parcialmente</span>';
                
                break;
                case 3:
                $data['data'][$i]['seg_status'] = '<span class="label label-danger pull-right">No Asistio</span>';
                
                break;
              
            }
            $data['data'][$i]['hra_ini'] = $value->seguimiento_administrativo->hora_inicio;
            $data['data'][$i]['hra_fin'] = $value->seguimiento_administrativo->hora_fin;
            $data['data'][$i]['seg_status_obs'] = $value->seguimiento_administrativo->descripcion;
          }else{
                $data['data'][$i]['seg_status'] ='<span class="label label-primary pull-right">Sin seguimiento</span>';
                $data['data'][$i]['seg_status_obs'] = 'No data';
                $data['data'][$i]['hra_ini'] = 'No data';
                $data['data'][$i]['hra_fin'] = 'No data';
            }

           if($value->status == 1) 
            $data['data'][$i]['action'] = '<input type="checkbox" name="turnCheckBox[]" data-id="'.$value->id.'" data-id_pcte="'.$value->patient->id.'">' ;
            else
            $data['data'][$i]['action'] = '';
          $i++;
    }
    return json_encode($data);
  }  


  public static function getProgressBar($pr)
  {
      switch (intval($pr['total'])) {
        case 0:
          $prg['bg-cl']='bg-danger'; 
          $prg['Prg'] = '<div class="progress" data-toggle="tooltip"  data-placement="top" title="SIN ASIGNACIÓN"><div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:100%;background:#fbe7d2;"><label class="text-danger">SIN ASIGNACIÓN 0%</label> </div></div>';
          return $prg;
        break;        
        case (intval($pr['total'])>1 &&   intval($pr['total']) < 40):
        $prg['bg-cl'] = 'bg-danger'; 
        $prg['Prg']='<div class="progress"  data-toggle="tooltip"  data-placement="top" title="Visualizar Porcentaje de asignación" ><div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:' . $pr['total'] . '%">' . $pr['total'] . '%</div></div>';
        return $prg;
        break;
        case ($pr['total'] >  40 && $pr['total'] <= 70):
          $prg['bg-cl'] = 'bg-warning';
          $prg['Prg']='<div class="progress" data-toggle="tooltip"  data-placement="top" title="Visualizar Porcentaje de asignación"><div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:' . $pr['total'] . '%">' . $pr['total'] . '%</div></div>';
          return $prg;
        break;
        case ($pr['total']> 70 && $pr['total'] <=100 ):
          $prg['bg-cl'] = 'bg-success';
          $prg['Prg'] = '<div class="progress" data-toggle="tooltip"  data-placement="top" title="Visualizar Porcentaje de asignación"><div class="progress-bar progress-bar-success  progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:' . $pr['total'] . '%"> ' . $pr['total'] . '%</div> <div class="progressbar progress-bar-danger progress-bar-striped" role="progressbar" style="color:#fff;" >' . (100 - $pr['total']) . '%</div></div>';
          return $prg;
          break;
        default:
          $prg['bg-cl']='bg-warning';
          $prg['Prg'] = '<div class="progress" data-toggle="tooltip"  data-placement="top" title="Visualización  del Porcentaje de asignación  ,supera el limite de horas permitidas "><div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:' . $pr['total'] . '%"> '.$pr['total'].'%</div></div>';
          return $prg;
          break;
      }
  }
  public static function readIndex()
  {
    $dt = new DateTime();
    $day = $dt->modify('first day of this month')->format('Y-m-d');
     $arrayPt=DB::select("CALL  CaregiversOrder('".$day."')");    
    foreach ($arrayPt as $o => $objPt) { 
      $graphic = CaregiversController::getProgressBar(CaregiversController::helpfordate($objPt->id));
      $hours = \App\Model\Homecare_tipo_cuidador::where('id_servicio',$objPt->id_servicio)->first();
      $rsmExcel=' <a  href="/TurnProfessionals/'.$objPt->id.'" ><img  class="img-rounded" src="img/listExcel.png" width="43" height="43" data-toggle="tooltip" data-placement="top" data-original-title="Resumen de asignación" > </a>';
      $buttons=' <a id="btnReloadCalendar" data-carerId="'.$hours->hours.'"   data-name=' . $objPt->name . ' data-id=' . $objPt->id . ' data-toggle="modal" ><img  class="img-rounded" src="img/calendar.png" width="46" height="46" data-toggle="tooltip" data-placement="top" data-original-title="Visualización calendario" > </a>
      <a  data-convert="1" data-ot=' . $objPt->idot .'  data-id=' . $objPt->id . '  data-toggle="modal" data-target="#deleteTurnMasiv" class="BtnrescheduleTurn" ><img  class="img-rounded" src="img/delet.png" width="45" height="45" data-toggle="tooltip" data-placement="top" data-original-title="Eliminación masiva" > </a>  ';                 
      if(CaregiversController::helpfordate($objPt->id)['total']>20) $buttons.=$rsmExcel;
      if(CaregiversController::helpfordate($objPt->id)['total']>50 &&  CaregiversController::helpfordate($objPt->id)['totalHp']<=372  &&  CaregiversController::helpfordate($objPt->id,date('Y-m-d',strtotime(date('Y-m-d')."+ 1 month")))['sumaH'] == 0 )      $buttons.='<a  id="rechedulesMonth" data-id=' . $objPt->id . ' ><img  class="img-rounded" src="img/rechedules.png" width="40" height="40" data-toggle="tooltip" data-placement="top" data-original-title="Programar Turnos para el siguiente mes " > </a>'; else $buttons.='';      
      echo '<tr><td class="text-center"><span class="badge">' . $o++ . '</span> </td><td class="text-center">(' . $objPt->identificacion . ') ' . $objPt->name . '</td><td class="text-center"> <span class="label label " style="background-color:#183684a8;font-size:13px;" >' . $objPt->nombre . '   <i class="glyphicon glyphicon-time"></i></span> </td><td class="text-center"><span style="font-size:13px;" class="label label-info">Activo</span> </td><td class="text-center  '. $graphic['bg-cl'].'">' . $graphic['Prg'] . '</td><td class="text-center"> <input type="hidden" id="HdNm" value=' . $objPt->name . '>  '.$buttons.'  </td></tr>';
    }
  }
  public function recheduleTurn(){
    $dt = new DateTime();
    $ini = $dt->modify('first day of this month')->format('Y-m-d');
    $end = $dt->modify('last day of  this month')->format('Y-m-d');
    $aryMonthPrevius = Homecare_paciente_cuidador::where('id_paciente', \Request::input('id_pt'))->whereBetween(DB::raw('DATE(fecha_inicia)'), [$ini, $end])->where('status',1)->get();
      foreach($aryMonthPrevius as $objCurrentMonth){          
        CaregiversController::dateCreatefull($objCurrentMonth->id_paciente, $objCurrentMonth->id_profesional, date('Y-m-d H:i', strtotime($objCurrentMonth->fecha_inicia . '+ 1 month ')), date('Y-m-d H:i' ,strtotime($objCurrentMonth->fecha_fin . '+ 1 month ') ) , $objCurrentMonth->observacion, $objCurrentMonth->color,$objCurrentMonth->relevo);
      }
    return 1;
  }
public function readTbdFull()
{

    $objPatient = Paciente::find(Request::input('idpt'));
    
    $carer = $objPatient->carevigers->where('status',1);
    $data = [];
    foreach ($carer as $i => $v) {
      if($v->relevo==1) $color="#00a9a9"; else $color=$v->color;
        $progressptCall=Homecare_Cuidador_Seguimiento::where('id_paciente_cuidador',$v->id)->get();
      if(date('H:i', strtotime($v->fecha_inicia))<'12:00') $dN='<img  width="21" height="17"src="/img/sol.png">'; else$dN='<img width="18" height="17" src="img/luna.png">';
        $data[] = array(
        'id'=>$v->id,
        'pt_id'   => $objPatient->identificacion,
        'pt_idrlt'   => $v->id_paciente,
        'pt_nm'   => $objPatient->name,
        'Pf_cc'   => $v->user->identificacion,
        'Pf_id'=> $v->id_profesional,
        'Pf_name'=> $v->user->name,
        'start'=>$v->fecha_inicia,
        'end'=>$v->fecha_fin,
        'title'=>  $v->user->name .  $dN,
        'ProgressCall'=>$progressptCall[0]->id_status,
        'backgroundColor'=>$color,
        'borderColor'=>$v->color);
    }
echo json_encode($data);
}
public static function helpfordate($id,$date=null,$idtable='id_paciente'){
    (is_null($date))? $d=date('Y-m-d'):$d=$date;
    $objPt=Paciente::find($id);
    $dt = new DateTime($d);
    $ini = $dt->modify('first day of this month')->format('Y-m-d');
    $end = $dt->modify('last day of  this month')->format('Y-m-d');
    $strEnd = Homecare_paciente_cuidador::where($idtable, $id)->whereBetween(DB::raw('DATE(fecha_inicia)'), [$ini, $end])->where('status',1)->get();
    $smu = 0;
    foreach ($strEnd as $obj) {
      $diff1 = new DateTime($obj->fecha_inicia);
      $diff2 = new DateTime($obj->fecha_fin);
      $smu += $diff1->diff($diff2)->h;
    }
    $c=DB::select('CALL CaregiversHours('.$id.')');
    $Hp = $c[0]->hours; 
    
    $dayNum = date('t', strtotime($d)); /** */
    $totalHp = ($Hp * $dayNum);
    $prg =($smu / $totalHp)*100;
    $rs=['total'=>round($prg),'sumaH'=> $smu,'totalHp'=> $totalHp];
    return $rs;
}
public static function  validDate($from,$to,$input){
  $frm=date('H:i',strtotime($from));
  $to=date('H:i',strtotime($to));
  $inp=date('H:i', strtotime($input));
      $dateFrom = DateTime::createFromFormat('!H:i',$frm);
      $dateTo = DateTime::createFromFormat('!H:i',$to);
      $dateInput = DateTime::createFromFormat('!H:i',$inp);
  if($dateFrom > $dateTo) $dateTo->modify('+1 day');
  return (($dateFrom < $dateInput  && $dateInput < $dateTo) || ($dateFrom < $dateInput->modify('+1 day') && $dateInput < $dateTo))? 1:0; 
}
public static function validationGeneral($id_tbl,$id_relation,$a1,$dateIni,$dateEnd){
($id_tbl== 'id_profesional')? $msj=505:$msj=500;
    $validationg = DB::table('homecare_paciente_cuidador')->where($id_tbl,$id_relation)->whereDate(DB::raw('DATE(fecha_inicia)'),$a1)->where('status',1)->get();
    foreach ($validationg as $objvld) {
      if (CaregiversController::validDate($objvld->fecha_inicia, $objvld->fecha_fin, $dateIni) == 1)   return $msj;
      if (CaregiversController::validDate($objvld->fecha_inicia, $objvld->fecha_fin, $dateEnd) == 1)   return $msj;
      if (CaregiversController::validDate($dateIni,$dateEnd, $objvld->fecha_inicia) == 1)   return $msj;
      if (CaregiversController::validDate($dateIni,$dateEnd, $objvld->fecha_fin) == 1)   return $msj;
    }
    $gbl = DB::table('homecare_paciente_cuidador')->where($id_tbl, $id_relation)->where('fecha_inicia', $dateIni)->where('fecha_fin', $dateEnd)->where('status', 1)->get();
    if(count($gbl)>0)  return $msj;
}
 public function CreateTurnMassiv(Request $ts)
  {
    $id_Patient = $ts->id_pt;
    $a1 = date('Y-m-d', strtotime($ts->stdt));      
    $validation3= CaregiversController::helpfordate($id_Patient,$a1);
    
    $sttime = substr($ts->stdt, 11, 16);
    $sm=0;   
    for ($i = $a1; $i <= $ts->endDate; $i = date("Y-m-d", strtotime($i . "+  1 days"))) {
      if(!empty($prf=CaregiversController::validationGeneral('id_profesional',$ts->car,$i, $i ."  " .date('H:i', strtotime($ts->stdt)) , $i. "  " .date('H:i', strtotime($ts->Enddt)) ))) return $prf;
      if(!empty($pt=CaregiversController::validationGeneral('id_paciente', $id_Patient, $i,$i ."  ".date('H:i',strtotime($ts->stdt)),$i ."  ". date('H:i', strtotime($ts->Enddt))))) return $pt;
      $sm += $ts->breakDay;
        $modfbreak=date('Y-m-d',strtotime($i.'+' . $sm . 'day'));
        $datebreak[] = $modfbreak;
        $foo[] = $i;
    }
if ($sm == 0) $fooAll = $foo; else $fooAll = array_diff($foo, $datebreak);
    $disumaH = 0;    
foreach ($fooAll as $vld => $allVld) {
      $date = new DateTime($allVld . " " . $sttime);
      $a = $date->format('Y-m-d H:i');
      $e = $ts->hdur;
      $dt2 = $date->modify('+' . $e . 'hours');
      $b = $dt2->format('Y-m-d H:i');
      $df1 = new DateTime($a);
      $df2 = new DateTime($b);
      $disumaH += $df1->diff($df2)->h;
      
}
    $tot = ($validation3['sumaH'] + $disumaH);
    if( intval($tot) > intval($validation3['totalHp']))  return 100;
    foreach ($fooAll as $y => $all) {
      $dateRetorn = new DateTime($all . " " . $sttime);
      $dateformat1 = $dateRetorn->format('Y-m-d H:i');
      $eq1 = $ts->hdur;
      $dateformat2 = $dateRetorn->modify('+' . $eq1 . 'hours')->format('Y-m-d H:i');
      CaregiversController::dateCreatefull($id_Patient, $ts->car, $dateformat1, $dateformat2, $ts->txt, $ts->lb);
    }
    return 1;
  }
  public function createTurn24h(){
    $rs=\Request::all();
    $dt = new DateTime($rs['monthDnl']); 
    $ini = $dt->modify('first day of this month')->format('Y-m-d');
    $end = $dt->modify('last day of this month')->format('Y-m-d');
    $daymorningNext=[]; $dayNightNext=[];
    for($x = $ini; $x <=$end; $x = date("Y-m-d", strtotime($x . "+  6 days"))) {
       $dayNight= date('Y-m-d', strtotime($x.'+ 2 day'));
       array_push($dayNightNext,$dayNight,date('Y-m-d',strtotime($dayNight.'+ 1 days')));
       $daymorning= date('Y-m-d', strtotime($x.'+ 1 days'));
       array_push($daymorningNext,$x,$daymorning);
    }    
    for($y=$ini; $y<= $end; $y = date("Y-m-d", strtotime($y . "+  1 days"))) {$all[]=$y;}     
        $merge=array_merge($daymorningNext,$dayNightNext); ksort($merge);
        $aryrelay=array_diff($all,$merge);
    for($vldM=0;$vldM<count($daymorningNext);$vldM++){        
    if(!empty($prf=CaregiversController::validationGeneral('id_profesional',$rs['carerOne24h'],$vldM, date('Y-m-d H:i' , strtotime( $daymorningNext[$vldM].'  07:00')) , date('Y-m-d H:i', strtotime($daymorningNext[$vldM].'  19:00')) ))) return $prf;      
    if(!empty($prf=CaregiversController::validationGeneral('id_profesional',$rs['carerTwo24h'],$vldM,$daymorningNext[$vldM].'  19:00' ,date('Y-m-d H:i', strtotime($daymorningNext[$vldM].'  07:00 ' . '+ 1 days'))  ))) return $prf;      
   

    if(!empty($prf=CaregiversController::validationGeneral('id_paciente',$rs['id_pt'],$vldM, date('Y-m-d H:i' , strtotime( $daymorningNext[$vldM].'  07:00')) , date('Y-m-d H:i', strtotime($daymorningNext[$vldM].'  19:00')) ))) return $prf;      
    if(!empty($prf=CaregiversController::validationGeneral('id_paciente',$rs['id_pt'],$vldM,$daymorningNext[$vldM].'  19:00' ,date('Y-m-d H:i', strtotime($daymorningNext[$vldM].'  07:00 ' . '+ 1 days'))  ))) return $prf;      
  }
    for($vldN=0;$vldN<count($dayNightNext);$vldN++){
    if(!empty($prf=CaregiversController::validationGeneral('id_profesional',$rs['carerThree24h'],$vldN,date('Y-m-d H:i', strtotime($dayNightNext[$vldN].'  07:00' )) ,date('Y-m-d H:i', strtotime($dayNightNext[$vldN].'  19:00')) ))) return $prf;      
    if(!empty($prf=CaregiversController::validationGeneral('id_profesional',$rs['carerOne24h'],$vldN,$dayNightNext[$vldN].'  19:00',date('Y-m-d H:i', strtotime($dayNightNext[$vldN].'  07:00' . '+ 1 days'))  ))) return $prf;      
  
    if(!empty($prf=CaregiversController::validationGeneral('id_paciente',$rs['id_pt'],$vldN,date('Y-m-d H:i', strtotime($dayNightNext[$vldN].'  07:00' )) ,date('Y-m-d H:i', strtotime($dayNightNext[$vldN].'  19:00')) ))) return $prf;      
    if(!empty($prf=CaregiversController::validationGeneral('id_paciente',$rs['id_pt'],$vldN,$dayNightNext[$vldN].'  19:00',date('Y-m-d H:i', strtotime($dayNightNext[$vldN].'  07:00' . '+ 1 days'))  ))) return $prf;      
  }
    foreach($aryrelay as $key=> $vl){
    if(!empty($prf=CaregiversController::validationGeneral('id_profesional',$rs['carerTwo24h'],$vl,date('Y-m-d H:i', strtotime($vl.'  07:00' ))  ,  date('Y-m-d H:i', strtotime($vl.'  19:00'))  ))) return $prf;      
    if(!empty($prf=CaregiversController::validationGeneral('id_profesional',$rs['carerThree24h'],$vl,date('Y-m-d H:i', strtotime($vl.'  19:00'))  , date('Y-m-d H:i', strtotime($vl.'  07:00' . '+ 1 days'))  ))) return $prf;      

    if(!empty($prf=CaregiversController::validationGeneral('id_paciente',$rs['id_pt'],$vl,date('Y-m-d H:i', strtotime($vl.'  07:00' ))  ,  date('Y-m-d H:i', strtotime($vl.'  19:00'))  ))) return $prf;      
    if(!empty($prf=CaregiversController::validationGeneral('id_paciente',$rs['id_pt'],$vl,date('Y-m-d H:i', strtotime($vl.'  19:00'))  , date('Y-m-d H:i', strtotime($vl.'  07:00' . '+ 1 days'))  ))) return $prf;      
    }      
      for($vldM=0;$vldM<count($daymorningNext);$vldM++){           
        CaregiversController::dateCreatefull($rs['id_pt'], $rs['carerOne24h'],date('Y-m-d H:i' , strtotime( $daymorningNext[$vldM].'  07:00')) , date('Y-m-d H:i', strtotime($daymorningNext[$vldM].'  19:00')),null,"#2f69eaee");        
        CaregiversController::dateCreatefull($rs['id_pt'],$rs['carerTwo24h'],$daymorningNext[$vldM].'  19:00' , date('Y-m-d H:i', strtotime($daymorningNext[$vldM].'  07:00 ' . '+ 1 days')),null,  "#8e7a19");          
      }
      for($vldN=0;$vldN<count($dayNightNext);$vldN++){      
        CaregiversController::dateCreatefull($rs['id_pt'],$rs['carerThree24h'], date('Y-m-d H:i', strtotime($dayNightNext[$vldN].'  07:00' )), date('Y-m-d H:i', strtotime($dayNightNext[$vldN].'  19:00')),null,"#129ec7"); 
        CaregiversController::dateCreatefull($rs['id_pt'],$rs['carerOne24h'],$dayNightNext[$vldN].'  19:00', date('Y-m-d H:i', strtotime($dayNightNext[$vldN].'  07:00' . '+ 1 days')) ,null,"#2f69eaee");             
      }
      foreach($aryrelay as  $vl){                 
        CaregiversController::dateCreatefull($rs['id_pt'],$rs['carerTwo24h'], date('Y-m-d H:i', strtotime($vl.'  07:00' )), date('Y-m-d H:i', strtotime($vl.'  19:00')),null,"#8e7a19"); 
        CaregiversController::dateCreatefull($rs['id_pt'],$rs['carerThree24h'],date('Y-m-d H:i', strtotime($vl.'  19:00')), date('Y-m-d H:i', strtotime($vl.'  07:00' . '+ 1 days')) ,null,"#129ec7");               
      }
    return 1;
  }
 public function  CreateCarerTurn(Request $ts){
    $id_Patient = $ts->id_pt;
    
    if (!empty($prf = CaregiversController::validationGeneral('id_profesional', $ts->car, $ts->dtsel, $ts->start, $ts->end))) return $prf;
    if (!empty($pt = CaregiversController::validationGeneral('id_paciente', $id_Patient, $ts->dtsel, $ts->start, $ts->end))) return $pt;
    $validation3 = CaregiversController::helpfordate($id_Patient,$ts->dtsel);
    $df1 = new DateTime($ts->start);
    $df2 = new DateTime($ts->end);
    $tot = ($validation3['sumaH'] + $df1->diff($df2)->h);
    if( intval($tot) > intval($validation3['totalHp']))  return 100;
    CaregiversController::dateCreatefull($id_Patient, $ts->car, $ts->start, $ts->end, $ts->txt, $ts->lb);
    return 1;
 }
  public function dateCreatefull($id_pt, $id_prf, $dateini, $dateend, $txt, $lb,$relay=0)
  { 
    $objCarer = new Homecare_paciente_cuidador();
    $objCarer->id_paciente = $id_pt;
    $objCarer->id_profesional = $id_prf;
    $objCarer->fecha_inicia = $dateini;
    $objCarer->fecha_fin =  $dateend;
    $objCarer->observacion = $txt;    
    if($lb=="Cuidador") $lb="#0080ff";  elseif($lb=="Cuidador_Tercero") $lb="#00a629"; else  $lb ;    
    $objCarer->color = $lb;
    $objCarer->relevo=$relay;
    $objCarer->save();
  }
  public static function readCarer($id){
        $p= General_Perfil::where('slug',$id)->first();
        echo '<optgroup  data-id='.$p->id.' label='.$p->nombre.'>';
        foreach ($p->profile_user as $y => $v){
        $us=User::find($v->pivot->id_user);
        echo  '<option data-id='.$p->id.' value='.$us->id.'>'. $us->name.'</option>';}
        echo '</optgroup>';
    }
  public  function deleteMasive(Request $ts){
    if($ts->bitMS==1){
    $dt = new DateTime();
    $end = $dt->modify('last day of  this month')->format('Y-m-d');
    $strEnd = Homecare_paciente_cuidador::where('id_paciente', $ts->id_pt)->whereBetween(DB::raw('DATE(fecha_inicia)'), [date('Y-m-d'),$end])->update(['status'=>0, 'id_obsanulation'=>$ts->tree]);
    }else{     $strEnd =Homecare_paciente_cuidador::where('id',$ts->id)->update(['status'=>0,'id_obsanulation'=>$ts->tree]); }
    $msj=['bit'=>$ts->bitMS,'id'=>$ts->id];
    echo json_encode($msj);
  }
  public function gettreenode(){
    $ar=General_Cuidador_Obsanulation::all();
    $tr=[];
        foreach ($ar as $y => $obj) {
          $tr[$y]['key']=$obj->id;
          $tr[$y]['title']=$obj->nombre;
          $tr[$y]['icon'] = "glyphicon glyphicon-exclamation-sign";
          $tr[$y]['checkbox']=true;
          }
    echo json_encode($tr);
}
public static function getcarerType(){
    $arryct=Homecare_tipo_cuidador::all();
    foreach($arryct as $obj){
    echo '<option value='.$obj->id.'>'.$obj->nombre.'</option>';
    }
}
public  function readPatient(){
  $arrayPt = Paciente::where('id_estado',1)->get();
   foreach ($arrayPt as $o => $objPt) {
      $nm[$o]=$objPt->name.'-'.$objPt->identificacion;
      $id[$o]=$objPt->identificacion.'-'.$objPt->name;
      $res=array_merge($nm,$id);
    }
    return $res;
  $id=\Request::input('id');
  $id_tpc=\Request::input('tpc');
  $consult=Paciente::where('identificacion',$id)->whereNotNull('id_tipo_cuidador')->get();
  if(count($consult)>0) return 0; else  return DB::update('update pacientes set id_tipo_cuidador=?  where  identificacion=?', [$id_tpc, $id]);
}
public static function homepac_between($id,$ini,$end,$st){
  return Homecare_paciente_cuidador::where('id_paciente', $id)->whereBetween(DB::raw('DATE(fecha_inicia)'), [$ini, $end])->where('status',$st)->get();  
}
  public function showTarget(){
    $dt = new DateTime(); 
    $ini = $dt->modify('first day of this month')->format('Y-m-d');
    $end = $dt->modify('last day of  this month')->format('Y-m-d');
    $ob=Paciente::find(\Request::input('id'));    
    $ntf=CaregiversController::homepac_between($ob->id,$ini,$end,0);
    $indi=CaregiversController::homepac_between($ob->id,$ini,$end,1);
    $ntf1= Homecare_paciente_cuidador::where('id_paciente', $ob->id)->whereBetween(DB::raw('DATE(fecha_inicia)'), [$ini, $end])->where('status',1)->distinct()->get(['id_profesional']);
    $c=DB::select('CALL CaregiversHours('.$ob->id.')');
    $ot=\App\Model\Homecare_Ordendetrabajo::find($c[0]->idot);
    
    if($ot->paciente->eps)$eps=$ot->paciente->eps->nombre; else  $eps='Falta EPS';
    if($ot->paciente->departamento) $dp=$ot->paciente->departamento->nombre; else $dp="<label class='text-danger'>Sin ubicacion</label> ";
    if($ot->paciente->municipio) $mnp=$ot->paciente->municipio->nombre;else $mnp="<label class='text-danger'>Sin ubicacion</label> ";
    if($ot->paciente->telefono) $tlf=$ot->paciente->telefono; else $tlf="<label class='text-danger'>--</label>";
    $aut=(is_null($ot->autorizacion))? '<label class="text-danger">No posee</label>': $ot->autorizacion;
    $msj['ul'][0]='<ul><li class="text-danger">Sin asignación</li></ul>';
    foreach($indi as $obrsm){ foreach($obrsm->changestatus as $changest){ $iresumen[]=$changest;} }
    foreach($ntf1 as $k=> $list){
    $msj['ul'][$k]='<ul><li class="text-success">   ('.$list->user->identificacion.')'.   $list->user->name.'</li></ul>';
    }
    $msj['info']='<div class="col-lg-8">
      <div class="bs-callout bs-callout-info" style="height:180px;"><h4>    Info. <i class="glyphicon glyphicon-info-sign"></i></h4><div class="col-lg-6">
      <ul><li> <tt>Identificación :</tt> '.$ot->paciente->tipodocumento->tag.' <b>('.$ot->paciente->identificacion.')  '.$ob->name.'</b> </li><li> <tt>Orden de Trabajo :</tt>  <b>'.$ot->id.'</b> </li><li> <tt>Servicio :</tt>  <b>'.$ot->paquete->nombre.'</b> </li><li> <tt>EPS: :</tt>  <b>'.$eps.'</b> </li></ul>
      </div>
      <div class="col-lg-6">
      <ul><li> <tt>Autorización :</tt> <b>'.  $aut  .'</b>  </li><li><tt>Validez :</tt>   <b>'.$ot->valida_desde .'/'. $ot->valida_hasta.'</b></li> <li><tt>Departamento :</tt> <b>'.$dp.'</b></li>  <li><tt>Ciudad :</tt>  <b>'.$mnp.'</b> </li> <li><tt>Telefono : </tt> <b>'. $tlf.'</b></li>      <li><a target="_blank" href='. url('/Paciente/'.$ob->id).'>Ver mas..</a></li></ul>
      </div></div></div>';
  
    if(count($ntf)>0) 
    $msj['notify']= '<div class="col-lg-2 pull-right"><a id="showInactiveturn" data-id='.$ob->id.' data-toggle="modal" data-target="#InactiveTurnall"><img class="img-rounded irad" src="img/nt.gif" width="72" height="70" data-toggle="tooltip" data-placement="top" data-original-title="Notificación" style="background:blanchedalmond;"></a></div>';
    if(count($iresumen)>0)
     $msj['indi']='<div class="col-lg-1 pull-right"><a id="showResumen" data-id='.$ob->id.' data-toggle="modal" data-target="#novedades"><img class="img-rounded irad" src="img/resumen.jpg" width="75" height="70" data-toggle="tooltip" data-placement="top" data-original-title="Resumen del mes"></a></div>';
   return $msj;
  }
  public  function showInactiveShift($id){
    $dt = new DateTime();
    $ini = $dt->modify('first day of this month')->format('Y-m-d');
    $end = $dt->modify('last day of  this month')->format('Y-m-d');
    $array= Homecare_paciente_cuidador::where('id_paciente',$id)->whereBetween(DB::raw('DATE(fecha_inicia)'),[$ini, $end])->where('status',0)->get();
    $d=[]; $res=[];
    $i=1;
    foreach ($array as $k=> $o){
      $d['conc']= '<span class="badge">'.$i++.'</span>';
      $d['nm'] =$o->user->identificacion.' - '. $o->user->name;
      $d['f_ini'] = $o->fecha_inicia;
      $d['f_fin'] = $o->fecha_fin;
      $d['obs'] = $o->seguimiento->nombre;
      $res[]=$d;
    }
    $json_data = array("data" => $res);
    echo json_encode($json_data);
  }
  public function InactivedShift(){
    $array = Homecare_paciente_cuidador::where('id_paciente',\Request::input('id'))->whereDate(DB::raw('DATE(fecha_inicia)'),\Request::input('sl'))->where('status', 0)->get();
    if(count($array)>0) return 1;
  }
  public static function readIndexProfessionals($id,$tpc=null)
  {
    $p= General_Perfil::where('slug',$id)->first();
    $i=1;
    foreach ($p->profile_user->where('active',1) as $o => $objPt) {
        $dt = new DateTime();
        $ini = $dt->modify('first day of this month')->format('Y-m-d');
        $end = $dt->modify('last day of  this month')->format('Y-m-d');
        $patc= Homecare_paciente_cuidador::where('id_profesional', $objPt->id)->whereBetween(DB::raw('DATE(fecha_inicia)'), [$ini, $end])->where('status',1)->get();  
        $graphic = CaregiversController::getProgressBar(CaregiversController::helpforPrf($patc)); 
        ($tpc==1)? $tpcarer='<span class="label label-default" style="font-size:13px;">Cuidador Cuidarte</span>': $tpcarer='<span  class="label label-default" style="background:green;font-size:13px;">Cuidador Tercero</span>';
        $buttons = ' <a  id="btnCldPrf"   data-id=' . $objPt->id . ' data-toggle="modal" ><img  class="img-rounded" src="img/calendar.png" width="46" height="46" data-toggle="tooltip" data-placement="top" data-original-title="Visualización calendario" > </a><a  data-toggle="modal" id="btnexcelshow" data-id='.$objPt->id.' data-target="#mdl_Excel"   ><img  class="img-rounded" src="img/listExcel.png" width="45" height="45" data-toggle="tooltip" data-placement="top" data-original-title="Cuadro de asignación" > </a>';
        echo '<tr><td class="text-center"><span class="badge">' . $objPt->id . '</span> </td><td class="text-center">(' . $objPt->identificacion . ') ' . $objPt->name . '</td><td class="text-center"><span style="font-size:13px;" class="label label-info">Activo</span> </td><td class="text-center" >'.$tpcarer.'</td><td class="text-center  ' . $graphic['bg-cl'] . '">' . $graphic['Prg'] . '</td><td class="text-center"> <input type="hidden" id="HdNm" value=' . $objPt->name . '>  ' . $buttons . '  </td></tr>';            
    }
  }
  public static function helpforPrf($array){
    $pr['total']=0;$disumaH=0;
    foreach ($array as $e => $dt) {
      $df1 = new DateTime($dt->fecha_inicia);
      $df2 = new DateTime($dt->fecha_fin);
      $disumaH += $df1->diff($df2)->h;
    }
    $dayNum = date('t');
    $totalHp = ($Hp * $dayNum);
    $prg =($smu / $totalHp)*100;
    $pr['total']=round(($disumaH/288)*100);    // 24 TURNOS MAXIMOS PARA EL SALARIO MINIMO * 12 TURNOS
    return  $pr;
  }
  public function  readCalendarPrf(){
    $pt = Homecare_paciente_cuidador::where('id_profesional',\Request::input('idprf'))->where('status', 1)->get();  
    $data = [];
    foreach ($pt as $i => $v) {
      $data[] = array(
        'id' => $v->id,
        'pt_id'   =>  $v->patient->identificacion,
        'pt_idrlt'   => $v->id_paciente,
        'pt_nm'   => $v->patient->name,
        'Pf_cc'   => $v->user->identificacion,
        'Pf_id' => $v->id_profesional,
        'Pf_name' => $v->user->name,
        'start' => $v->fecha_inicia,
        'end' => $v->fecha_fin,
        'backgroundColor' => $v->color,
        'borderColor' => $v->color
      );
    }
    echo json_encode($data);
  }

public function callPatient(){
  $rs=\Request::all();
  $objpt=Homecare_paciente_cuidador::find($rs['id']); $st=3;
if($rs['st']==1){
$d1b= new Datetime($objpt->fecha_inicia);
$d2b= new Datetime($objpt->fecha_fin);
$dfb= $d1b->diff($d2b)->h;
$d1= new Datetime($rs['ini']);
$d2= new Datetime($rs['end']);
$df= $d1->diff($d2)->h;
if($dfb==$df){ $st=1;  }else{ $st=2;}
}
if($st==3){ $inih=null; $finh=null; }else{ $inih=$rs['ini']; $finh=$rs['end']; }
$obj=new Homecare_Cuidador_Seguimiento();
    $obj->id_paciente_cuidador=$rs['id'];
    $obj->hora_inicio=$inih;
    $obj->hora_fin=$finh;
    $obj->id_status=$st;
    $obj->descripcion=$rs['obs'];
    $obj->save();
    return 1;
}
  public function InfoPrfEdit(Request $rs){
    $dt = new DateTime();
    $ini = $dt->modify('first day of this month')->format('Y-m-d');
    $end = $dt->modify('last day of  this month')->format('Y-m-d');
    $patc= Homecare_paciente_cuidador::where('id_profesional',Request::input('id_prf'))->where('id_paciente', Request::input('id_pt'))->whereBetween(DB::raw('DATE(fecha_inicia)'), [$ini, $end])->where('status',1)->get();  
    $ntf1= Homecare_paciente_cuidador::where('id_profesional', Request::input('id_prf'))->whereBetween(DB::raw('DATE(fecha_inicia)'), [$ini, $end])->where('status',1)->distinct()->get(['id_paciente']);
    $res['patient'][0]='<ul><li class="text-danger">Sin asignación</li></ul>';
    $objus=User::find(Request::input('id_prf'));
    foreach($ntf1 as $t=> $pt){      
      $res['patient'][$t]= '<div class="col-lg-6 text-success">'.$pt->patient->identificacion.'-'.$pt->patient->name.'</div>';
    }
    $res['profesional'][0]=$objus->identificacion.'-'.$objus->name;    
    foreach($patc as $y => $obj){
      $res['h_ini']= date('H:i', strtotime($obj->fecha_inicia));
      $res['h_fin']=date('H:i',strtotime($obj->fecha_fin));
      $res['prf']=$obj->user->name;
    }
    return $res;
  }
  public function updateCarer(Request $rs){
    $dt = new DateTime(date('Y-m-d'));
    $ini = $dt->format('Y-m-d');
    $end = $dt->modify('last day of  this month')->format('Y-m-d');
  for ($i = $ini; $i <= $end; $i = date("Y-m-d", strtotime($i . "+ 1 days"))) {
    if(!empty($prf=CaregiversController::validationGeneral('id_profesional',Request::input('carerNew'),$i, $i ."  " .Request::input('h_ini'), $i. "  " .Request::input('h_fin') ))) return $prf;
    }
  for ($i = $ini; $i <= $end; $i = date("Y-m-d", strtotime($i . "+ 1 days"))) {
    $patc= Homecare_paciente_cuidador::where('id_profesional',Request::input('id_prf'))->where('id_paciente', Request::input('id_pt'))->where('fecha_inicia',$i ."  " . Request::input('h_ini'))->where('fecha_fin',$i. "  " .Request::input('h_fin'))->where('status',1)->update(['id_profesional'=>Request::input('carerNew')]); 
  }    
  return 1;
   }
   public function resumen($id){
    $dt = new DateTime();
    $ini = $dt->modify('first day of this month')->format('Y-m-d');
    $end = $dt->modify('last day of  this month')->format('Y-m-d');
    $patc= Homecare_paciente_cuidador::where('id_paciente',$id)->whereBetween(DB::raw('DATE(fecha_inicia)'), [$ini, $end])->where('status',1)->get();
  $num=1; $data=[]; $conc=0;
    $idallassig=[]; $idntf=[];
    foreach($patc as $i=> $ntf){
      $idallassig[]=$ntf->id;
        foreach($ntf->changestatus as $o => $mtvs){
        $idntf[]=$mtvs->id_paciente_cuidador;
        $data['data'][$conc]['con']=$num++;   
        $data['data'][$conc]['dt-ini']=$ntf->fecha_inicia;
        $data['data'][$conc]['dt-end']=$ntf->fecha_fin;
        $data['data'][$conc]['h-ini']=$mtvs->hora_inicio;
        $data['data'][$conc]['h-end']=$mtvs->hora_fin;
        $data['data'][$conc]['prf']=$ntf->user->identificacion .'  '. $ntf->user->name;
        $data['data'][$conc]['st']=CaregiversController::switchlb($mtvs->id_status);
        $data['data'][$conc]['descrip']=$mtvs->descripcion;
        $data['data'][$conc]['stid']=$mtvs->id_status;        
        $conc++;
      }        
    }
    $diff=array_diff($idallassig,$idntf);
    foreach($diff as $id){
      $ntf1=Homecare_paciente_cuidador::find($id);
      $data['data'][$conc]['con']=$num++;   
      $data['data'][$conc]['dt-ini']=$ntf1->fecha_inicia;
      $data['data'][$conc]['dt-end']=$ntf1->fecha_fin;
      $data['data'][$conc]['h-ini']='<s>'.date('H:i',strtotime($ntf1->fecha_inicia)).'</s>';
      $data['data'][$conc]['h-end']='<s>'.date('H:i',strtotime($mtvs->hora_fin)).'</s>';
      $data['data'][$conc]['prf']=$ntf1->user->identificacion .'  '. $ntf1->user->name;
      $data['data'][$conc]['st']=CaregiversController::switchlb(4);
      $data['data'][$conc]['descrip']="Pendiente por llamar";
      $conc++;
    }
    echo json_encode($data);
}
public function switchlb($id){
    switch($id){
      case 1:
        return '<label class="label label-success" data-toggle="tooltip" data-placement="top"  data-title="El profesional cumplio con el turno">Cumplimiento total    <i class="glyphicon glyphicon-check"></label>';
      break;
      case 2:
        return '<label class="label label-warning" data-toggle="tooltip" data-placement="top"  data-title="Faltaron Horas por prestar">Cumplimiento medio    <i class="glyphicon glyphicon-warning-sign "></label>';
      break;
      case 3:
        return '<label class="label label-danger" data-toggle="tooltip" data-placement="top"  data-title="No cumple con el turno ">Incumplimiento    <i class="glyphicon glyphicon-ban-circle  "></label>';
      break;
      case 4:
        return '<label class="label label-primary" data-toggle="tooltip" data-placement="top"  data-title="Pendiente por llamar">Pendiente por llamar   <i style="color:#e8f705;" class="glyphicon glyphicon-phone-alt"></label>';
      break;
    }
}
public static function getCheckdays($month){
  $dt = new DateTime($month);   
  $ini = $dt->modify('first day of this month')->format('Y-m-d');
  $end = $dt->modify('last day of  this month')->format('Y-m-d');
  $num=0;
  for($i=$ini;$i<=$end;$i++){
   echo '<div class="col-lg-2">
   <div class="funkyradio"><div class="funkyradio-success">
    <input type="checkbox" name="daysCheck" id="checkbox'.$num.'" value='.$i.'  />
    <label for="checkbox'.$num.'"> '. date('d-M', strtotime($i)).'</label>
    </div></div></div>';
    ++$num;
  }
}
 public function programMasive(){
  $rs=\Request::all();
  for($i=0;$i<count($rs['array']); $i++){    
    $datetm = new DateTime($rs['array'][$i]['days'].''. $rs['array'][$i]['H_ini']); 
    $dateEnd=$datetm->modify('+'.$rs['array'][$i]['Dur'].' hours')->format('Y-m-d H:i'); 
  if(!empty($prf=CaregiversController::validationGeneral('id_profesional',intval($rs['array'][$i]['carer']),$rs['array'][$i]['days'],  date('Y-m-d H:i', strtotime($rs['array'][$i]['days'] .''. $rs['array'][$i]['H_ini'])) ,$dateEnd ))) return $prf;    
  if(!empty($pt=CaregiversController::validationGeneral('id_paciente',intval($rs['id_pt']) ,$rs['array'][$i]['days'],  date('Y-m-d H:i', strtotime($rs['array'][$i]['days'] .''. $rs['array'][$i]['H_ini'])) ,$dateEnd  ))) return $pt;
  }
  for($x=0;$x<count($rs['array']);$x++){        
    $datetm = new DateTime($rs['array'][$x]['days'].''. $rs['array'][$x]['H_ini']); 
    $dateEnd=$datetm->modify('+'.$rs['array'][$x]['Dur'].' hours')->format('Y-m-d H:i'); 
    $bit=($rs['array'][$x]['color']==1)? 1:0;
    CaregiversController::dateCreatefull(intval($rs['id_pt']) ,intval($rs['array'][$x]['carer']), date('Y-m-d H:i', strtotime($rs['array'][$x]['days'] .''. $rs['array'][$x]['H_ini'])),$dateEnd,null,$rs['array'][$x]['color'],$bit); 
  }
  return 1;
 }
public static function diffDaysprogrammer($id){
  $dt = new DateTime();   
  $ini = $dt->modify('first day of this month')->format('Y-m-d');
  $end = $dt->modify('last day of  this month')->format('Y-m-d');
  $assign=CaregiversController::homepac_between($id,$ini,$end,1);
  for($i=$ini;$i<=$end;$i++){$alldays[]=$i;}
  foreach($assign as $assignPt){ $days[]= date('Y-m-d',strtotime($assignPt->fecha_inicia)); }

  return  $dif=array_diff($alldays,$days);
}
public function Dt_relay(){

  $dif=CaregiversController::diffDaysprogrammer(\Request::input('id'));
  $tl=[]; $p=0;
  foreach($dif as $j=> $dt){
    $tl['data'][$p]['id']= '<div>'.$dt.' <i class="glyphicon glyphicon-time"></i></div>';    
    $p++;
  }
  echo json_encode($tl);
  
}
public function assignrelay(Request $ts){
  
  $id_Patient = $ts->id_pt;
  $dif=CaregiversController::diffDaysprogrammer($id_Patient);
    $sttime = substr($ts->stdt, 11, 16);
    $sm=0;
    foreach($dif as $i){
      $objdt_end= new DateTime($i ."  ". $ts->h_ini);
      $date_end = $objdt_end->modify('+' . $ts->h_dur . 'hours')->format('Y-m-d H:i');
      if(!empty($prf=CaregiversController::validationGeneral('id_profesional',$ts->carer,$i, $i ."  " .date('H:i', strtotime($ts->h_ini)) , $date_end ))) return $prf;
      if(!empty($pt=CaregiversController::validationGeneral('id_paciente', $id_Patient, $i,$i ."  ".date('H:i',strtotime($ts->h_ini)),$date_end ))) return $pt;
    }

    foreach($dif as $i){
      $objdt_end= new DateTime($i ."  ". $ts->h_ini);
      $date_end = $objdt_end->modify('+' . $ts->h_dur . 'hours')->format('Y-m-d H:i');
      CaregiversController::dateCreatefull($id_Patient, $ts->carer,$i ."  ". $ts->h_ini ,$date_end ,$ts->txt, $ts->lb,1);
    }
return 1;
}
public static function drawings($position,$sheet,$height,$widt,$path='img/Cuidarte_logo.png')
    {
        $drawing = new \PHPExcel_Worksheet_Drawing;
        $drawing->setName('Cuidarte en casa');
        $drawing->setDescription('Cuidarte en casa ');
        $drawing->setPath(public_path($path));
        $drawing->setCoordinates($position);
        $drawing->setWorksheet($sheet);
        $drawing->setHeight($height);
        $drawing->setWidth($widt);
        return $drawing;
    }
public static function listTurn($id_prf,$month){

  $out=\Excel::create('Cuadro de cuidadores', function($excel) use($id_prf,$month) {  
    $dt = new DateTime($month);
    $ini = $dt->modify('first day of this month')->format('Y-m-d');
    $end = $dt->modify('last day of  this month')->format('Y-m-d');
    $patc= Homecare_paciente_cuidador::where('id_profesional',$id_prf)->whereBetween(DB::raw('DATE(fecha_inicia)'), [$ini, $end])->where('status',1)->distinct()->get(['id_paciente']);
    
    for($i=0;$i<count($patc);$i++){      
      $objpt=Paciente::find($patc[$i]['id_paciente']);
      $excel->sheet($objpt->identificacion,  function($sheet) use($id_prf,$ini,$end,$objpt) {
      $sheet->setStyle(array('font'=>array('name'=>'Arial','size'=>11)));            
      $objuser=User::find($id_prf);    
    $dir=$objpt->street_first_field->nombre ."  ".$objpt->dir_first_field_text ."  ".$objpt->street_second_field->nombre ."  ".$objpt->dir_second_field_text;  
    $letter='C'; $x=1; $letterA='A';
    $row=1;
    CaregiversController::drawings('Z1',$sheet,195,175);
    $sheet->mergeCells("B3:D4");
    $sheet->mergeCells("B5:F5");
    $sheet->setCellValueByColumnAndRow($row,3,'Sr Contratista');
    $sheet->setCellValueByColumnAndRow($row,5,$objuser->name);
    $styleArray = array( 'font' => array( 'bold' => true ) ); $sheet->getStyle('B3')->applyFromArray($styleArray);$sheet->getStyle('B21')->applyFromArray($styleArray);
    $diassemana = array("dom","lun","mar","mié","jue","vie","sáb");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $sheet->mergeCells("B7:AF7");
    $sheet->mergeCells("B8:J8");
    $sheet->setCellValueByColumnAndRow($row,7,'De acuerdo  a su  comunicación del   '.date('d')." de ".$meses[date('n')-1].  ',   le confirmamos  en cuales de sus dias  disponibles ,  utilizaremos sus servicios  para el paciente    '. $objpt->name);
    $sheet->setCellValueByColumnAndRow($row,8,' identificado con cedula de ciudadania  C.C  ' .$objpt->identificacion);
    $sheet->mergeCells("B11:H11");
    $sheet->setCellValueByColumnAndRow($row,11,'Direccion : ' .$dir);
    $sheet->mergeCells("J11:N11");
    $sheet->setCellValue('J11','Barrio : ' .$objpt->barrio->nombre);
    $sheet->mergeCells("B13:H13");
    $sheet->setCellValueByColumnAndRow($row,13,'Telefono  : ' .$objpt->celular .' - '.$objpt->celular2);  
    $sheet->mergeCells("J13:M13");
    $sheet->setCellValue('J13','Ciudad : ' . $objpt->municipio->nombre);
    $sheet->setCellValue('B18','DIA');
    $sheet->setCellValue('B19','HORAS');    
    $row1=2;
        for($i=$ini;$i<=$end;$i++){         
          $sheet->setBorder('B18:'.$letter.'19','thin');
          $sheet->setBorder('C17:'. $letter. '17', 'thin');
          $styleArray = array( 'font' => array( 'bold' => true ) ); $sheet->getStyle($letter.'17')->applyFromArray($styleArray);
          $sheet->setCellValue($letter.'18',$x++);
          $sheet->setCellValue($letter.'17',  $diassemana[date('w',strtotime($i))]);        
          $conslptlt= Homecare_paciente_cuidador::where('id_paciente',$objpt->id)->where('id_profesional',$id_prf)->whereDate(DB::raw('DATE(fecha_inicia)'),$i)->where('status',1)->get();         
          if(!empty($conslptlt[0])){                     
          if(date('H:i',strtotime($conslptlt[0]->fecha_inicia))<'12:00') $day_night='D'; else $day_night='N';
          $sheet->setCellValueByColumnAndRow($row1,19,$day_night);  
          }else{  $sheet->setCellValueByColumnAndRow($row1,19,'LL'); }
          $row++;$letter++; $letterA++; $row1++;
        }
        $sheet->setCellValue('B21','ATT :');   
        $sheet->setCellValue('C21',Auth::user()->name);
        $sheet->setCellValue('C22','Auxiliar Cuidarte en casa  S.A.S');
        $sheet->mergeCells("C21:H21");$sheet->mergeCells("C22:H22");$sheet->mergeCells("Q23:V23"); 
        $sheet->setCellValue('Q23','Recibido  :   ____________________');           
        $sheet->setCellValue('S24','C.C');   
        $sheet->setOrientation('landscape');
    });           
  }
  $excel->sheet('Consentimiento cuidador', function ($sheet)  use($month){
    $sheet->setStyle(array('font'=>array('name'=>'Arial','size'=>11)));      
    $sheet->mergeCells('B4:I4');
    $sheet->mergeCells('B10:O10');
    $sheet->mergeCells('B12:AC12');
    $sheet->mergeCells('C7:F7');    
    $sheet->mergeCells('B20:D20');
    $sheet->mergeCells('B23:D23');       
    $styleArray = array( 'font' => array( 'bold' => true,'size'=>12 ) ); $sheet->getStyle('B3:B9')->applyFromArray($styleArray); $sheet->getStyle('B21')->applyFromArray($styleArray);
    $dt = new DateTime($month);
    $ini = $dt->modify('first day of this month')->format('Y-m-d');
    $end = $dt->modify('last day of  this month')->format('Y-m-d');
    $diassemana = array("dom","lun","mar","mié","jue","vie","sáb");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $row=1; $lettertw='C';
    $sheet->setCellValueByColumnAndRow($row,4,'Santiago de Cali , '. $meses[date('n' , strtotime($month) )-1] .' 01  del '.date('Y'));  
    $sheet->setCellValueByColumnAndRow($row,$row+15,'Dia');
    $sheet->setCellValueByColumnAndRow($row,$row+16,'Horas');
    $sheet->setCellValueByColumnAndRow($row,$row+6,' Sres.');
    $sheet->setCellValueByColumnAndRow($row+1,$row+6,'______________________');
    $sheet->setCellValueByColumnAndRow($row,$row+19,'Atentamente ,');
    $sheet->setCellValueByColumnAndRow($row,$row+22,'______________________');
    $sheet->setCellValueByColumnAndRow($row,$row+23,'C.C');
    $sheet->setCellValueByColumnAndRow($row,$row+9,' Yo ___________________________  con C.C #  ________________________');
    $sheet->setCellValueByColumnAndRow($row,$row+11,'A continuación  les comunico mi disponibilidad para prestarle el servicio de cuidador en el mes de  ____________________ para el paciente _____________________ ');      
    for($a=$ini;$a<=$end;$a++){
      $sheet->setBorder('C15:'.$lettertw.'15','thin');
      $sheet->setBorder('B16:'. $lettertw. '17', 'thin');
      $styleArray = array( 'font' => array( 'bold' => true ) ); $sheet->getStyle($lettertw.'15')->applyFromArray($styleArray);
      $sheet->setCellValue($lettertw.'15',  $diassemana[date('w',strtotime($a))]);        
     $sheet->setCellValueByColumnAndRow($row+1,16,$row);
      $row++; $lettertw++;
    }
    $sheet->setOrientation('landscape');
  
  });
  $excel->setActiveSheetIndex(0);    
  })->export('xls');
  return $out; /* CHANGE */
  }

  public function mDeleteTurnPrf(){
    $turns = Request::input('data');
    foreach ($turns as $key => $value) {
      $turno = \App\Model\Homecare_Paciente_Cuidador::find($value);
      $turno->delete();
    }
  }

  public function prfTurn($prf){
    
    
    $dt = new DateTime();
    $ini = $dt->modify('first day of this month')->format('Y-m-d');
    $turns = \App\Model\Homecare_Paciente_Cuidador::where('id_profesional',$prf)->where('fecha_inicia','>=',$ini)->get();
    $data = [];
    $i=0;
    foreach ($turns as $key => $value) {
      $data['data'][$i]['id'] = $value->id;
      $data['data'][$i]['paciente'] = $value->patient->name;
      $data['data'][$i]['fecha_inicia'] = $value->fecha_inicia;
      $data['data'][$i]['fecha_fin'] = $value->fecha_fin;
      $data['data'][$i]['action'] ='<input type="checkbox" name="turnCheck[]" value="'.$value->id.'" >';
      $i++;
    }
    return json_encode($data);
  }


  public function TurnProfessionals($id_pt){      
    $dt = new DateTime();
    $ini = $dt->modify('first day of this month')->format('Y-m-d');
    $end = $dt->modify('last day of  this month')->format('Y-m-d');
    $diassemana = array("dom","lun","mar","mié","jue","vie","sáb");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  $Date=['Id_pt'=>$id_pt,'Ini'=>$ini,'End'=>$end,'Diassemana'=>$diassemana,'Mes'=>$meses];  
 \Excel::create('Cuadro de cuidadores', function($excel) use($Date) {  
      $excel->sheet('Resumen programación', function($sheet) use($Date) {
      $sheet->setStyle(array('font'=>array('name'=>'Arial','size'=>11)));
      $objpt=Paciente::find($Date['Id_pt']);    
      $dir=$objpt->street_first_field->nombre ."  ".$objpt->dir_first_field_text ."  ".$objpt->street_second_field->nombre ."  ".$objpt->dir_second_field_text;       
      CaregiversController::drawings('B1',$sheet,195,175); 
      $row=1; $col=1; $dias=1; $column=15; 
      $styleArray = array( 'font' => array( 'bold' => true ) ); $sheet->getStyle('B13')->applyFromArray($styleArray);  
      $styleCenter = array('alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
      $sheet->setCellValueByColumnAndRow($row,7, $objpt->name.  ' identificado con cedula de ciudadania  C.C  ' . $objpt->identificacion);   
      $sheet->setCellValueByColumnAndRow($row,9,'Direccion : ' .$dir);   
      $sheet->setCellValueByColumnAndRow($row+3,9,'Barrio : ' .$objpt->barrio->nombre);
      $sheet->setCellValueByColumnAndRow($row,11,'Telefono  : ' .$objpt->celular .' - '.$objpt->celular2);  
      $sheet->setCellValueByColumnAndRow($row+3,11,'Ciudad : ' .$objpt->municipio->nombre);           
      $sheet->mergeCells("E9:J9");       
     $sheet->mergeCells("E11:H11");       
      $sheet->mergeCells("B9:D9"); 
      $sheet->mergeCells("B11:C11"); 
      $sheet->mergeCells("B7:L7"); 
      
      $sheet->setCellValue('B13','Nombre Cuidador');  
      $sheet->mergeCells("B13:B14");             
      $letter='C'; $num='14';  $nmt='15';
      $aryPrf= Homecare_paciente_cuidador::where('id_paciente',intval($Date['Id_pt']))->whereBetween(DB::raw('DATE(fecha_inicia)'), [$Date['Ini'],$Date['End']])->where('status',1)->distinct()->get(['id_profesional']);                    
      for($p=0;$p<count($aryPrf);$p++){        
        $sheet->setCellValueByColumnAndRow(1,$col+14, $aryPrf[$p]->user->name .' C.C  ' .$aryPrf[$p]->user->identificacion);         
        for($y=$Date['Ini'];$y<=$Date['End'];$y++){  
          $styleArray = array( 'font' => array( 'bold' => true ) ); $sheet->getStyle($letter.'13')->applyFromArray($styleArray);
          $sheet->setBorder('C13:'. $letter. '14', 'thin');          
          $sheet->setBorder('C15:'.$letter.$nmt,'thin');                             
          $sheet->setCellValueByColumnAndRow($row+1,13,$Date['Diassemana'][date('w',strtotime($y))]);$sheet->setCellValueByColumnAndRow($row+1,14,$dias);
          $conslptlt= Homecare_paciente_cuidador::where('id_paciente',intval($Date['Id_pt']))->where('id_profesional',$aryPrf[$p]->user->id)->whereDate(DB::raw('DATE(fecha_inicia)'),$y)->where('status',1)->get();                          
        if(isset($conslptlt[0])){          
        if(date('H:i',strtotime($conslptlt[0]->fecha_inicia))<'12:00') $day_night='D'; else $day_night='N';
            $sheet->setCellValueByColumnAndRow($row+1,$column,$day_night);               
        }else{           
            $sheet->setCellValueByColumnAndRow($row+1,$column,'LL');                
        }  
        ++$row; ++$dias; ++$letter;
      }
      $dias=1; ++$column; $row=1; $letter='C'; ++$col; ++$num;  ++$nmt;     
      $sheet->setBorder('B13:'.'B'.$num,'thin'); 
      $sheet->getStyle('B13:'.'B'.$num)->applyFromArray($styleCenter);        
    } 
    $sheet->setOrientation('landscape');
    });  
    })->export('xls');
  } 
}
