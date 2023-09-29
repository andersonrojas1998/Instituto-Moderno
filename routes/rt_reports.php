<?php
Route::group(['prefix' => 'Reportes'], function(){
    Route::get('/inicio', 'ReportsController@index');    
    Route::get('/getReportApproved/{period}/{grade}', 'ReportsController@getReportApproved');    
});
