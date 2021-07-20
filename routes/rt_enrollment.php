<?php
//Route::get('/loadExcelEnrollmentr', 'BoletinController@loadExcelEnrollment'); /** Lectura de matriculas excel */
Route::get('/printPdfEnrollment', 'BoletinController@loadExcelEnrollment'); 
Route::group(['prefix' => 'matricula'], function(){
    Route::get('inicio', 'MatriculasController@index'); 
    Route::get('creacion', 'MatriculasController@index_create'); 
    Route::get('listEnrollment', 'MatriculasController@listEnrollment'); 
});
