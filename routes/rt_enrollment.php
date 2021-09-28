<?php
//Route::get('/loadExcelEnrollmentr', 'BoletinController@loadExcelEnrollment'); /** Lectura de matriculas excel */
Route::get('/pdfEnrollment/{id}/{status}/{idgrade?}', 'MatriculasController@pdfEnrollment'); 
Route::get('/matricula-inicio', 'MatriculasController@registerEnrollment'); 

Route::group(['prefix' => 'matricula'], function(){
    Route::get('inicio', 'MatriculasController@index'); 
    Route::get('creacion', 'MatriculasController@index_create'); 
    Route::get('listEnrollment', 'MatriculasController@listEnrollment');
    Route::get('/searching/student/{id}', 'MatriculasController@searchStudent');
    Route::get('/searching/father/{id}', 'MatriculasController@searchAcudiente');
    Route::post('/storeEnrollement', 'MatriculasController@storeEnrollement');
    Route::get('/listChangeStatus', 'MatriculasController@listChangeStatus');
    Route::post('/edit_enrollement', 'MatriculasController@edit_enrollement');
    Route::get('/ficha-matricula', 'MatriculasController@index_fichaMatricula');
});