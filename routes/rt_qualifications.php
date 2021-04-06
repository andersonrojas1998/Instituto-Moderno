<?php
Route::get('/Calificaciones/inicio', 'CalificacionesController@index');
Route::get('/Calificaciones/formato-excel', 'CalificacionesController@indexLoadExcelFormat');
Route::get('/QualificationExcel/{idgrade}/{teacher}/{period}/{course}', 'CalificacionesController@generatedEnrollmentQualification');
Route::get('/QualificationTable', 'CalificacionesController@alumnCourse');
//Route::get('/loadUser', 'BoletinController@loadUser');
// Route::get('/loadGroup', 'BoletinController@loadGroup');
Route::post('/readEnrollmentQualification', 'CalificacionesController@readEnrollmentQualification');