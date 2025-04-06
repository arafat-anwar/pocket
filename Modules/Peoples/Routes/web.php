<?php

Route::prefix('peoples')->group(function() {
    Route::resource('employees', 'EmployeeController');
    Route::resource('users', 'UsersController');
    Route::resource('change-password', 'ChangePasswordController');
});
