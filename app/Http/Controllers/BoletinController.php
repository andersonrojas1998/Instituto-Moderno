<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoletinController extends Controller
{
    
    public function index(){
        return view('boletin.index_boletin');
    }
    public function genetedBulletin(){

        return $pdf = \PDF::loadView('boletin.pdf_boletin')->stream('archivo.pdf');       
       //$pdf->setPaper('letter', 'landscape');
        //    return $pdf->download();        

    }


}
