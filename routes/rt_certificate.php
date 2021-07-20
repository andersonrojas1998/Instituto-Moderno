<?php
Route::get('/certificado/inicio', 'CertificatedController@indexCertificate');
Route::get('/certificadoPdf/{year}/{student}/{date}/{grade}', 'CertificatedController@certificatePdf');
Route::get('/constancia/inicio', 'CertificatedController@indexConstancia');
Route::get('/constanciaPdf/{student}/{date}', 'CertificatedController@constanciaPdf');
Route::get('/studentsGrades/{grado}/{ano}', 'CertificatedController@studentsForGradeYear');