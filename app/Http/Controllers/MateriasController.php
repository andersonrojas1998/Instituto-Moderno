<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class MateriasController extends Controller
{
    public function index(){
        return view('materias.index_materias');
    }
    public function dt_materias(){
     $mat=DB::SELECT("SELECT nombre,orden_print,tag FROM asignatura");
      $data=[];
      foreach($mat as $key => $us){                            
          $data['data'][$key]['con']=$key;   
          $data['data'][$key]['nombre']=$us->nombre;
          $data['data'][$key]['tag']=$us->tag;   
          $data['data'][$key]['orden_print']=$us->orden_print;
          $data['data'][$key]['actions']='';
      }
      return json_encode($data);
    }
}
