<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        //
       Schema::defaultStringLength(191);
       
       if (!(\Request::ip()=="127.0.0.1" || \Request::ip()=="::1")){
           \URL::forceScheme('https');
        }
    }
}
