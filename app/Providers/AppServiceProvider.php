<?php

namespace Techademia\Providers;

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
        Validator::extend('video_url', function ($attribute, $value, $parameters, $validator) {
            $url = array_find($value); //hypothetical, if embed is found in $value
            if($url) return $value;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
