<?php

Route::prefix('setups')->group(function() {
    Route::resource('/', 'SetupsController');

    Route::resource('system-information', 'SystemInformationController');

    Route::post('update-user-column-visibilities', 'SystemInformationController@updateUserColumnVisibilities');
    
    Route::resource('modules', 'ModulesController');

    Route::resource('menu', 'MenuController');

    Route::resource('submenu', 'SubmenuController');
    Route::get('submenu/{module_id}/get-menu', 'SubmenuController@getMenu');

    Route::resource('crons', 'CronsController');

    Route::resource('roles', 'RolesController');
    Route::resource('permissions', 'PermissionsController');
    Route::resource('role-permissions', 'RolePermissionsController');

    Route::resource('countries', 'CountryController');
    Route::resource('cities', 'CityController');
    Route::resource('entry-types', 'EntryTypeController');

    Route::resource('switch-language', 'SwitchLanguageController');
});
