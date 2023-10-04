<?php

namespace App\Providers;

use App\Contracts\Services\GithubServiceContract;
use App\Contracts\Services\LoginServiceContract;
use App\Services\GithubService;
use App\Services\LoginService;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            LoginServiceContract::class,
            LoginService::class,
        );

        $this->app->bind(
            GithubServiceContract::class,
            GithubService::class,
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
