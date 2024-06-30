<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Company\AuthController::class)->group(function(){
    Route::post('register','register') ;
    Route::post('login','login');
    Route::get('logout','logout')->middleware('auth:company');
    Route::get('refresh','refresh')->middleware('auth:company');
});

Route::middleware('auth:company')->controller(\App\Http\Controllers\company\JobController::class)->prefix('job')->group(function() {
    Route::post('create', 'createJob');
    Route::post('update/{job_id}','updateJob');
    Route::get('delete/{jobId}', 'deleteJob');
    Route::get('index', 'showCompanyJobs');
    Route::get('Request/{job_id}','JobRequest');
    Route::get('showSubCategories' ,'showSubCategories' ) ;
});


