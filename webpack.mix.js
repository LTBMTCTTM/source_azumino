const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css').sourceMaps();
mix.copyDirectory('resources/js/common.js', 'public/js/common.js');
mix.copyDirectory('resources/js/goods-history.js', 'public/js/goods-history.js');
mix.copyDirectory('resources/js/shipping-destinations.js', 'public/js/shipping-destinations.js');
mix.copyDirectory('resources/js/workers.js', 'public/js/workers.js');
mix.copyDirectory('resources/js/dist', 'public/dist');
