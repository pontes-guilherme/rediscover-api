<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\ProjectsController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [LoginController::class, 'login'])->middleware('guest');
    Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('projects')->group(function () {
        Route::get('', [ProjectsController::class, 'index']);
        Route::get('{id}', [ProjectsController::class, 'show']);
        Route::delete('{id}', [ProjectsController::class, 'destroy']);
    });
});
