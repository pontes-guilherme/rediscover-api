<?php

namespace App\Providers;

use App\Contracts\Services\GithubServiceContract;
use App\Contracts\Services\LoginServiceContract;
use App\Contracts\Services\ProjectServiceContract;
use App\Services\GithubService;
use App\Services\LoginService;
use App\Services\ProjectService;
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

        $this->app->bind(
            ProjectServiceContract::class,
            ProjectService::class,
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
