<?php

namespace Techademia\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class CustomValidationServiceProvider
 * @package Techademia\Providers
 */
class CustomValidationServiceProvider extends ServiceProvider
{

    const SHORT_URL_REGEX  = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
    const LONG_URL_REGEX  = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('youtube', function ($attribute, $value, $parameters, $validator) {
            if (!preg_match(self::LONG_URL_REGEX, $value, $matches)) {
                return false;
            };
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
