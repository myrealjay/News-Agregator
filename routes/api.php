<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PreferenceController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function() {
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['prefix' => 'articles', 'middleware' => ['auth:sanctum']], function() {
    Route::get('', [ArticleController::class, 'index']);
    Route::get('{id}', [ArticleController::class, 'show']);
});

Route::group(['prefix' => 'preference', 'middleware' => ['auth:sanctum']], function() {
    Route::get('', [PreferenceController::class, 'index']);
    Route::post('', [PreferenceController::class, 'store']);
});
