<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/setups', function (Request $request) {
    return $request->user();
});
