const mix = require('laravel-mix');

mix.js('resources/assets/dashboard/js/app.js', 'public/assets/dashboard/js');

mix.styles([
    'resources/assets/dashboard/css/plugins/*.css'
], 'public/assets/dashboard/css/bundle.css');

mix.styles([
    'resources/assets/dashboard/css/app.css'
], 'public/assets/dashboard/css/app.css');

mix.copyDirectory('resources/assets/dashboard/images', 'public/assets/dashboard/images')
mix.copyDirectory('resources/assets/dashboard/fonts', 'public/assets/dashboard/fonts')

/*************/
/*** guest ***/
/*************/
mix.js('resources/assets/guest/js/app.js', 'public/assets/guest/js');
mix.styles([
    'resources/assets/guest/css/plugins/*.css'
], 'public/assets/guest/css/bundle.css');

mix.styles([
    'resources/assets/guest/css/app.css'
], 'public/assets/guest/css/app.css');

mix.copyDirectory('resources/assets/guest/images', 'public/assets/guest/images')
mix.copyDirectory('resources/assets/guest/fonts', 'public/assets/guest/fonts')
