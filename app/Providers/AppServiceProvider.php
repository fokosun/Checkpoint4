<?php

namespace Techademia\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package Techademia\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    const SHORT_URL_REGEX  = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
    const LONG_URL_REGEX  = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('youtube', function ($attribute, $value, $parameters, $validator) {
            $matches = [];

            if (preg_match(self::LONG_URL_REGEX, $value, $long)) {
                $matches[] = end($long);
            }

            if (preg_match(self::SHORT_URL_REGEX, $value, $short)) {
                $matches[] = end($short);
            }

            return !empty($matches);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(){}
}
