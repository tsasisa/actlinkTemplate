<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('production')) {
            $cachePath = '/tmp/cache';
            if (!File::exists($cachePath)) {
                File::makeDirectory($cachePath, 0755, true);
            }

            config(['cache.stores.file.path' => $cachePath]);
        }

        Paginator::useBootstrap();
    }
}
