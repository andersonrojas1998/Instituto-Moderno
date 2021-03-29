<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DocenteController extends Controller
{
    public function index(){
        return view('docentes.index_docentes');
    }
    public function dt_user(){
       $dataUs=DB::select("SELECT tb1.identificacion,tb1.name,tb1.estado,tb1.celular,tb2.nombre as sede,tb1.cargo,tb1.genero FROM users as tb1 inner join sede as tb2 on tb1.id_sede=tb2.id_sede");
        $data=[];
        foreach($dataUs as $key => $us){                            
            $data['data'][$key]['con']=$key;   
            $data['data'][$key]['dni']=$us->identificacion;
            $data['data'][$key]['name']=$us->name;   
            $data['data'][$key]['celular']=$us->celular;
            $data['data'][$key]['genero']=$us->genero;
            $data['data'][$key]['sede']=$us->sede;
            $data['data'][$key]['cargo']=$us->cargo;
            $data['data'][$key]['estado']=$us->estado;
        }
        return json_encode($data);          
    }
}
