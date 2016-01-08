var gulp = require('gulp');
var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
gulp.task('elixir', function(){
    elixir(function(mix) {
        mix.task('elixir', phpUnit());
    });
});

gulp.task('default', ['elixir']);
