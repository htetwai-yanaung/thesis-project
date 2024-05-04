<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Modules\Core\App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once(app_path().'/Helpers/Helper.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $settings = Setting::first();
            $view->with([
                'siteName' => $settings->site_name,
                'siteImage' => $settings->site_image
            ]);
        });
    }
}
