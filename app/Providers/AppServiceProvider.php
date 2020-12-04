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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(auth('foreman')->user()) {
            \Config::set( 'auth.defaults.guard', 'foreman' );
        } else {
            \Config::set( 'auth.defaults.guard', 'subforeman' );
        }
    }
}
