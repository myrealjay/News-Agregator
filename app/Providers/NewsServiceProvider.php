<?php

namespace App\Providers;

use App\Services\GuardianService;
use App\Services\NewsAPIService;
use App\Services\NYTimesService;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('newsapi', NewsAPIService::class);
        $this->app->bind('guardian', GuardianService::class);
        $this->app->bind('nytimes', NYTimesService::class);
    }
}
