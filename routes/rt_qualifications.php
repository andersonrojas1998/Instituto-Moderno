<?php
Route::get('/Calificaciones/inicio', 'CalificacionesController@index');
Route::get('/Calificaciones/formato-excel', 'CalificacionesController@indexLoadExcelFormat');
Route::get('/Calificaciones/resumen', 'CalificacionesController@indexSummaryRating');
Route::get('/Calificaciones/summaryRating/{period}', 'CalificacionesController@summaryRating');
Route::get('/QualificationExcel/{idgrade}/{teacher}/{period}/{course}', 'CalificacionesController@generatedEnrollmentQualification');
Route::get('/QualificationTable', 'CalificacionesController@alumnCourse');
Route::post('/readEnrollmentQualification', 'CalificacionesController@readEnrollmentQualification');
Route::get('/Calificaciones/Puntuacion-promedio', 'CalificacionesController@indexScoreStudents');
Route::get('/Calificaciones/scoreStudents/{grade}/{period}', 'CalificacionesController@scoreStudents');
Route::get('/Calificaciones/delQualifications/{period}/{course}/{grade}', 'CalificacionesController@delQualifications');