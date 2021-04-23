<?php
Route::get('/genetedBulletin/{matricula}/{date}/{period}/{obs}/{grade}', 'BoletinController@genetedBulletin'); /** generar boletin */
Route::get('/genetedBulletinForGrades/{grade}/{exp}/{period}/{obs}', 'BoletinController@genetedBulletinForGrades'); /** generar boletin Masivo */
Route::get('/Boletin/inicio', 'BoletinController@index');
Route::get('/grades', 'BoletinController@grades');
Route::get('/students/{grade}', 'BoletinController@studentsForGrades');
Route::get('/obsBulletin', 'BoletinController@obsBulletin');

/** lOAD FILES */
// Route::get('/tsExcel', 'BoletinController@loadExcelMatricula');
//Route::get('/loadUser', 'BoletinController@loadUser');
// Route::get('/loadGroup', 'BoletinController@loadGroup');
//Route::get('/loadCourseTeacher', 'BoletinController@loadCourseTeacher'); /** CARGA DE DOCENTES */
//Route::get('/loadDirectorGrade', 'BoletinController@loadDirectorGrade');