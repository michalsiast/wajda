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

mix.react('resources/js/components/Gallery.js', 'public/js/components')

// mix
//     .styles([
//         // 'resources/css/vendors/bootstrap.css',
//         // 'resources/css/vendors/dashboard.css',
//     ], 'public/css/main.min.css')
//     .scripts([
//         // 'resources/js/vendors/jquery-3.5.1.slim.min.js',
//         // 'resources/js/vendors/bootstrap.js',
//         // 'resources/js/vendors/feather.min.js',
//         // 'resources/js/vendors/dashboard.js',
//     ], 'public/js/main.min.js')
//     .version();
