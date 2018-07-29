<?php

namespace App\Providers;

use App\Services\UserService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();
    }

    private function registerServices(): void
    {
        $this->app->singleton(ArticleService::class);
        $this->app->singleton(AuthorService::class);
        $this->app->singleton(UserService::class);
    }
}
