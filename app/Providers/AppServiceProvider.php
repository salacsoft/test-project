<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(
            "App\Http\Services\PromotionInterface",
            "App\Http\Services\PromotionRepository"
        );

        $this->app->bind(
            "App\Http\Services\RequiredInfoInterface",
            "App\Http\Services\RequiredInfoRepository"
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
