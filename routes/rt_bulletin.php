<?php
Route::get('/ts', 'BoletinController@genetedBulletin'); /** generar boletin */
// Route::get('/tsExcel', 'BoletinController@loadExcelMatricula');
Route::get('/Boletin/inicio', 'BoletinController@index');