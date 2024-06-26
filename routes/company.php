<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Company\AuthController::class)->group(function(){
    Route::post('register','register') ;
    Route::post('login','login');
    Route::get('logout','logout')->middleware('auth:company');
    Route::get('refresh','refresh')->middleware('auth:company');
});

Route::middleware('auth:company')->controller(\App\Http\Controllers\company\JobController::class)->group(function() {
    Route::post('createJob', 'createJob');
    Route::get('deleteJob/{jobId}', 'deleteJob');
    Route::get('jobs', 'showCompanyJobs');
});
