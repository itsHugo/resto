<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Using Quebec locale
        // Used by ModelFactory to seed database
//        $this->app->singleton(\Faker\Generator::class, function () {
//            return \Faker\Factory::create('fr_CA');
//        });
    }
}
