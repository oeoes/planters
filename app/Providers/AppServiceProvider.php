<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

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
        // if(auth('foreman')->user()) {
        //     \Config::set( 'auth.defaults.guard', 'foreman' );
        // } else {
        //     \Config::set( 'auth.defaults.guard', 'subforeman' );
        // }

        if(auth('foreman')->user()) {

            \Config::set( 'auth.defaults.guard', 'foreman' );

        } elseif(auth('subforeman')->user()) {

            \Config::set( 'auth.defaults.guard', 'subforeman' );

        } elseif(auth('assistant')->user()) {

            \Config::set( 'auth.defaults.guard', 'assistant' );

        } elseif(auth('farmmanager')->user()) {

            \Config::set( 'auth.defaults.guard', 'farmmanager' );

        } elseif(auth('superadmin')->user()) {

            \Config::set( 'auth.defaults.guard', 'superadmin' );

        }
    }
}
