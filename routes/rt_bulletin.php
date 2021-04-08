<?php
Route::get('/genetedBulletin/{matricula}/{date}/{period}', 'BoletinController@genetedBulletin'); /** generar boletin */
Route::get('/Boletin/inicio', 'BoletinController@index');
Route::get('/grades', 'BoletinController@grades');
Route::get('/students/{grade}', 'BoletinController@studentsForGrades');

/** lOAD FILES */
// Route::get('/tsExcel', 'BoletinController@loadExcelMatricula');
//Route::get('/loadUser', 'BoletinController@loadUser');
// Route::get('/loadGroup', 'BoletinController@loadGroup');
Route::get('/loadCourseTeacher', 'BoletinController@loadCourseTeacher');