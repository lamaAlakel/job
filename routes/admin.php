<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Admin\AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('logout', 'logout')->middleware('auth:admin');
});

Route::controller(\App\Http\Controllers\Admin\JobController::class)->prefix('job')->group(function () {
    Route::get('index', 'showJobs')->middleware('auth:admin');
    Route::get('pending', 'getPendingJobs')->middleware('auth:admin');
    Route::get('approve', 'getApprovedJobs')->middleware('auth:admin');
    Route::get('approve/{job_id}', 'approveJob')->middleware('auth:admin');
    Route::get('delete/{job_id}', 'deleteJob')->middleware('auth:admin');
});
Route::controller(\App\Http\Controllers\Admin\CompanyController::class)->prefix('company')->group(function () {
    Route::get('browse', 'browseCompany')->middleware('auth:admin');
    Route::get('delete/{user_id}', 'deleteCompany')->middleware('auth:admin');
});

Route::controller(\App\Http\Controllers\Admin\CategoryController::class)->prefix('category')->group(function () {
    Route::post('store', 'addCategory')->middleware('auth:admin');
    Route::get('delete/{category_id}', 'deleteCategory')->middleware('auth:admin');
    Route::get('index', 'showCategory')->middleware('auth:admin');
});

Route::controller(\App\Http\Controllers\Admin\SubCategoryController::class)->prefix('subCategory')->group(function () {
    Route::post('store','addSubCategory')->middleware('auth:admin');
    Route::get('delete/{subcategory_id}','deleteSubCategory')->middleware('auth:admin');
    Route::get('index','showSubCategory')->middleware('auth:admin');
});
