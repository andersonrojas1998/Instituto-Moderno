<?php
namespace App\Http\Controllers;
use Request;
use DB;
use App\Model\grado;
class GradeController extends Controller
{
  public function index(){
      return view('grados.index_grados');
  }
  public function gradesAll(){
    return json_encode(DB::SELECT("SELECT id_grado,grupo FROM grado"));
  }
  public function jornadaAll(){
    return json_encode(DB::SELECT("SELECT id_jornada AS id,nombre as name,codigo FROM jornada"));
  }
  public function nivelEducativoAll(){
    return json_encode(DB::SELECT("SELECT id_nivel_educativo as id,nombre as name FROM nivel_educativo"));
  }
  public function showEdit($id){    
    $grados=DB::SELECT("SELECT tb1.id_grado,tb1.tag,tb1.nombre,tb1.grupo,tb2.nombre as jornada,tb2.id_jornada,tb2.id_jornada,users.id as idUser,users.name from grado as tb1
                        INNER join jornada as tb2 on tb1.id_jornada=tb2.id_jornada
                        LEFT join users  on tb1.id_docente=users.id WHERE tb1.id_grado='$id' ");
    return json_encode($grados);
  }  
  public function update(){
    
    $grado=grado::where('nombre',Request::input('nombre'))->where('grupo',Request::input('grupo'))->where('id_jornada',Request::input('id_jornada'))->get();
    if(!isset($grado[0]->id)){    
      DB::table('grado')
              ->where('id_grado', Request::input('id_grado'))
              ->update([
                    'nombre' => Request::input('nombre'),
                    'id_jornada' => Request::input('id_jornada'),
                    'tag' => Request::input('tag'),
                    'id_docente' => Request::input('id_docente')                
                  ]
          );
      return 1;

    }else{
      return 2;
    }

  }
  
  
  public function create(){

    $grado=grado::where('nombre',Request::input('nombre'))->where('grupo',Request::input('grupo'))->get();
    if(!isset($grado[0]->id)){
         DB::table('grado')->insert([
            'nombre' =>Request::input('nombre'),
            'grupo' => Request::input('grupo'),
            'id_jornada'=>Request::input('jornada'),
            'id_nivel_educativo'=> Request::input('educativo'),
            'tag'=>Request::input('tag'),
            'id_docente'=>Request::input('id_docente')            
        ]);
        return 1;
    }else{
        return 2;
    }
  }
  public function dt_grades(){
    $year=date('Y');
   $grados=DB::SELECT("SELECT tb1.id_grado,tb1.nombre,tb1.grupo,tb2.nombre as jornada,users.name,(SELECT count(*) from matricula as tb3 where  tb3.id_grado=tb1.id_grado AND tb3.id_estado_matricula=1 AND tb3.año='$year') as alumnos from grado as tb1
                        INNER join jornada as tb2 on tb1.id_jornada=tb2.id_jornada
                        LEFT join users  on tb1.id_docente=users.id");
    $data=[];
    foreach($grados as $key => $us){                            
        $data['data'][$key]['id']=$us->id_grado;   
        $data['data'][$key]['con']=$key;   
        $data['data'][$key]['nombre']=$us->nombre;
        $data['data'][$key]['grupo']=$us->grupo;   
        $data['data'][$key]['jornada']=$us->jornada;   
        $data['data'][$key]['name']=$us->name;
        $data['data'][$key]['alumnos']=$us->alumnos;        
        $data['data'][$key]['actions']='';
    }
    return json_encode($data);
  }
}
