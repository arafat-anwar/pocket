<?php

Route::prefix('language')->group(function() {
    Route::resource('languages', 'LanguageController');
    Route::resource('language-libraries', 'LanguageLibraryController');
});
