<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Company\AuthController::class)->group(function(){
    Route::post('register','register') ;
    Route::post('login','login');
    Route::get('logout','logout')->middleware('auth:company');
    Route::get('refresh','refresh')->middleware('auth:company');
});

Route::controller(\App\Http\Controllers\company\JobController::class)->group(function() {
    Route::post('/companies/{companyId}/jobs', 'createJob');
    Route::delete('/companies/{companyId}/jobs/{jobId}', 'deleteJob');
});
