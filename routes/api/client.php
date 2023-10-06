<?php

use App\Http\Controllers\Client\Auth\GithubAuthController;
use App\Http\Controllers\Client\GithubRepositoriesController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\ProjectsController;
use App\Http\Controllers\Client\TagsController;
use App\Http\Controllers\Client\TechnologiesController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::get('github/url', [GithubAuthController::class, 'getGithubOauthURI']);
    Route::get('github/callback', [GithubAuthController::class, 'callback']);
    Route::post('logout', [GithubAuthController::class, 'logout']);
});

Route::prefix('github')->group(function () {
    Route::get('repository', [GithubRepositoriesController::class, 'get']);
});

Route::prefix('technologies')->group(function () {
    Route::get('', [TechnologiesController::class, 'index']);
});

Route::prefix('tags')->group(function () {
    Route::get('', [TagsController::class, 'index']);
});

Route::prefix('projects')->group(function () {
    Route::post('', [ProjectsController::class, 'store']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show']);
    });
});
