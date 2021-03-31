<?php
Route::get('/Calificaciones/inicio', 'CalificacionesController@index');
Route::get('/QualificationExcel', 'CalificacionesController@generatedEnrollmentQualification');
Route::get('/QualificationTable', 'CalificacionesController@alumnCourse');
//Route::get('/loadUser', 'BoletinController@loadUser');
Route::get('/loadGroup', 'BoletinController@loadGroup');