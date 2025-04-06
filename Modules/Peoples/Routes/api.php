<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/peoples', function (Request $request) {
    return $request->user();
});

Route::get('employees','API\APIController@employees');
Route::get('employee/{employee_id}','API\APIController@employee');
Route::get('employee/{employee_id}/image','API\APIController@image');
Route::get('employee/{employee_id}/children','API\APIController@children');

Route::get('salary-details-by-date/{date}','API\APIController@salaryDetails');
