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
    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'public/assets/admin/vendors/iconfonts/font-awesome/css/all.min.css',
    'public/assets/admin/vendors/css/vendor.bundle.addons.css',
    'public/assets/admin/css/style.css'
], 'public/css/all.css');
