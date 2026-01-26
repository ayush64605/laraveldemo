<?php

namespace App\Providers;

use App\Settings\GeneralSettings;
use App\Settings\ThemeSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use View;

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
    public function boot(GeneralSettings $settings, ThemeSetting $themeSetting): void
    {
        if (Schema::hasTable("settings")) {
            Config::set('app.name', $settings->site_name);
            View::share('setting', $settings);
            View::share('themesetting', $themeSetting);
        }
    }
}
