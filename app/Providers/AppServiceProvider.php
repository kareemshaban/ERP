<?php

namespace App\Providers;

use App\Models\SystemSettings;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $initData = SystemSettings::all()->first();
        view()->share('init_data',$initData);
        Schema::defaultStringLength(191);
    }
}
