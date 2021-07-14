<?php
Route::group(['prefix' => 'periodos'], function(){
    Route::get('inicio', 'PeriodoController@index');
    Route::get('all', 'PeriodoController@dt_perido');
    Route::get('show/{id}', 'PeriodoController@show');
    Route::post('edit', 'PeriodoController@edit');
    Route::get('closeTime/{id}', 'PeriodoController@closeTime');
    Route::get('validateTimePeriod/{id}', 'PeriodoController@validateTimePeriod');
});