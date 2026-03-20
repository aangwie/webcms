<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Mendukung mode Shared Hosting (cPanel) dimana public foldernya adalah public_html
        $publicHtmlPath = base_path('../public_html');
        if (is_dir($publicHtmlPath)) {
            $this->app->usePublicPath($publicHtmlPath);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
