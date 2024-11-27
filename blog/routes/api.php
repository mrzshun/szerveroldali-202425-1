<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register',     [ApiController::class,'register'])  ->name('api.register');
Route::post('login',        [ApiController::class,'login'])     ->name('api.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout',       [ApiController::class,'logout'])    ->name('api.logout');
    Route::post('user',         [ApiController::class,'user'])      ->name('api.user');    
});

