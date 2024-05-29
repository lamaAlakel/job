<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Admin\AuthController::class)->group(function (){
    Route::post('register','register');
    Route::post('login','login');
    Route::get('logout','logout')->middleware('auth:admin');

    Route::get('showJobs','showJobs')->middleware('auth:admin');
    Route::get('pending','getPendingJobs')->middleware('auth:admin');
    Route::get('approve','getApprovedJobs')->middleware('auth:admin');
    Route::get('approve/{job_id}','approveJob')->middleware('auth:admin');
    Route::get('deleteJob/{job_id}','deleteJob')->middleware('auth:admin');

    Route::get('browse','browseCompany')->middleware('auth:admin');
    Route::get('delete/{user_id}','deleteCompany')->middleware('auth:admin');

    Route::post('add','addCategory')->middleware('auth:admin');
    Route::get('delete/{category_id}','deleteCategory')->middleware('auth:admin');
    Route::get('show','showCategory')->middleware('auth:admin');

    Route::post('add','addSubCategory')->middleware('auth:admin');
    Route::get('delete/{subcategory_id}','deleteSubCategory')->middleware('auth:admin');
    Route::get('show','showSubCategory')->middleware('auth:admin');



});
