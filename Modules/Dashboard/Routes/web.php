<?php

Route::prefix('dashboard')->group(function() {
    Route::get('/', 'DashboardController@index');
    Route::post('save-chart', 'DashboardController@saveChart');
});


