<?php

use App\Http\Controllers\Client\Auth\GithubAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::get('github/url', [GithubAuthController::class, 'getGithubOauthURI']);
    Route::get('github/callback', [GithubAuthController::class, 'callback']);
    Route::post('logout', [GithubAuthController::class, 'logout']);
});
