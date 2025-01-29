<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'articles'], function() {
    Route::get('', [ArticleController::class, 'index']);
    Route::get('{id}', [ArticleController::class, 'show']);
});
