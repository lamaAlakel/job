<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Admin\AuthController::class)->group(function (){
    Route::post('register','register');
    Route::post('login','login');
    Route::get('logout','logout')->middleware('auth:admin');

});
