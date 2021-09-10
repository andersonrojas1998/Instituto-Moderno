<?php
//Route::get('/loadExcelEnrollmentr', 'BoletinController@loadExcelEnrollment'); /** Lectura de matriculas excel */
Route::get('/pdfEnrollment', 'MatriculasController@pdfEnrollment'); 
Route::get('/matricula-inicio', 'MatriculasController@registerEnrollment'); 

Route::group(['prefix' => 'matricula'], function(){
    Route::get('inicio', 'MatriculasController@index'); 
    Route::get('creacion', 'MatriculasController@index_create'); 
    Route::get('listEnrollment', 'MatriculasController@listEnrollment');
    Route::get('/searching/student/{id}', 'MatriculasController@searchStudent');
});