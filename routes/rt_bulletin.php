<?php
Route::get('/genetedBulletin/{matricula}/{date}', 'BoletinController@genetedBulletin'); /** generar boletin */
// Route::get('/tsExcel', 'BoletinController@loadExcelMatricula');
Route::get('/Boletin/inicio', 'BoletinController@index');

Route::get('/grades', 'BoletinController@grades');
Route::get('/students/{grade}', 'BoletinController@studentsForGrades');