<?php
Route::get('/grados/inicio', 'GradeController@index');
Route::get('/dt_grades', 'GradeController@dt_grades');
Route::get('/gradesAll', 'GradeController@gradesAll');
Route::get('/jornadaAll', 'GradeController@jornadaAll');
Route::get('/nivelEducativoAll', 'GradeController@nivelEducativoAll');
Route::post('/grade/created', 'GradeController@create');
Route::post('/grade/update', 'GradeController@update');
Route::get('/grados/showEdit/{id}', 'GradeController@showEdit');
