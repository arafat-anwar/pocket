<?php
Route::get('/', function(){
    return redirect('pocket');
});

Route::get('change-language/{code}', function($code){
    $language = \Modules\Language\Entities\Language::where('code', $code)->first();
    if(isset($language->code)){
        session()->put('language', $language->code);
        session()->put('language-flag', $language->flag);
        session()->put('language-name', $language->name);
        session()->put('language-direction', $language->direction);
        session()->forget('sidebar');
    }
    return redirect('/');
});

Route::get('sign-in', 'AuthController@signIn');
Route::post('sign-in', 'AuthController@login');

Route::get('sign-up', 'AuthController@signUp');
Route::post('sign-up', 'AuthController@register');

Route::get('forgot-password', 'AuthController@forgotPassword');
Route::post('forgot-password', 'AuthController@passwordResetLink');

Route::get('recover-password/{token}', 'AuthController@recoverPassword');
Route::post('recover-password', 'AuthController@updatePassword');

Route::get('sign-out', function(){
    if(auth()->check()){
        auth()->logout();
    }
    return redirect('/');
});

Route::get('activities', 'ProfileController@activities');

Route::get('profile', 'ProfileController@profile');
Route::post('profile', 'ProfileController@updateProfile');

Route::get('update-photo', 'ProfileController@photo');
Route::post('update-photo', 'ProfileController@updatePhoto');

Route::get('update-password', 'ProfileController@password');
Route::post('update-password', 'ProfileController@updatePassword');

Route::prefix('pocket')->group(function() {
    Route::get('/', 'PocketController@index');

    Route::get('/calculator', 'PocketController@calculator');

    Route::post('saveIncomeEntry','PocketController@saveIncomeEntry');
	Route::post('saveExpensesEntry','PocketController@saveExpensesEntry');
	Route::get('getEntryHead/{start_date}/{end_date}/{text}','PocketController@entryHead');
	Route::get('getEntryBody/{start_date}/{end_date}/{text}','PocketController@entryBody');
	Route::get('latestPocket','PocketController@latestPocket');

	Route::get('entryEdit/{entry_id}','PocketController@entryEdit');
	Route::post('entryEditSubmit/{entry_id}','PocketController@entryEditSubmit');
	Route::get('entryDelete/{entry_id}','PocketController@entryDelete');

	Route::get('searchIncomeTitles/{text}','PocketController@searchIncomeTitles');
	Route::get('searchExpenseTitles/{text}','PocketController@searchExpenseTitles');

	Route::get('status','PocketController@status');
	Route::get('status/{key}','PocketController@statusReport');

	Route::get('inquiry','PocketController@inquiryIndex');
	Route::post('inquiry','PocketController@inquiry');

	Route::get('find-and-replace','PocketController@findAndReplace');
	Route::post('find','PocketController@find');
	Route::post('replace','PocketController@replace');

	Route::get('report','PocketController@reportIndex');
	Route::post('report','PocketController@report');

	Route::get('balance','PocketController@balance');
	Route::get('balance/{year}','PocketController@balanceByYear');
	Route::get('balance-entries/{date}','PocketController@balanceEntries');
});
