<?php
Route::get('/docentes/inicio', 'DocenteController@index');
Route::get('/dt_user', 'DocenteController@dt_user');
Route::get('/showTeacher', 'DocenteController@showTeacher');
Route::get('/showGradesAssign', 'DocenteController@gradeAssignments');
Route::get('/assignmentCourseTeacher', 'DocenteController@assignmentCourseTeacher');