<?php
Route::group(['prefix' => 'Calificaciones'], function(){
    Route::get('/inicio', 'CalificacionesController@index');
    Route::get('/formato-excel', 'CalificacionesController@indexLoadExcelFormat');
    Route::get('/resumen', 'CalificacionesController@indexSummaryRating');
    Route::get('/summaryRating/{period}', 'CalificacionesController@summaryRating');    
    Route::get('/Puntuacion-promedio', 'CalificacionesController@indexScoreStudents');
    Route::get('/scoreStudents/{grade}/{period}', 'CalificacionesController@scoreStudents');
    Route::get('/delQualifications/{period}/{course}/{grade}', 'CalificacionesController@delQualifications');
    Route::post('/qualificationsOnline', 'CalificacionesController@qualificationsOnline');
});
Route::get('/QualificationExcel/{idgrade}/{teacher}/{period}/{course}', 'CalificacionesController@generatedEnrollmentQualification');
Route::get('/QualificationTable', 'CalificacionesController@alumnCourse');
Route::post('/readEnrollmentQualification', 'CalificacionesController@readEnrollmentQualification');
