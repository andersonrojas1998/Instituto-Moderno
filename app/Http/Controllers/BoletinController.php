<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoletinController extends Controller
{
    
    public function index(){
        return view('boletin.index_boletin');
    }


}
