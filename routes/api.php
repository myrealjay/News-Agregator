<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function() {
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['prefix' => 'articles', 'middleware' => ['auth:sanctum']], function() {
    Route::get('', [ArticleController::class, 'index']);
    Route::get('{id}', [ArticleController::class, 'show']);
});
