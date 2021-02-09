const mix = require('laravel-mix');

mix.js('resources/assets/dashboard/js/app.js', 'public/assets/dashboard/js');

mix.styles([
        'resources/assets/dashboard/css/plugins/*.css'
    ] , 'public/assets/dashboard/css/bundle.css') ;

mix.styles([
        'resources/assets/dashboard/css/app.css'
    ], 'public/assets/dashboard/css/app.css');

mix.copyDirectory('resources/assets/dashboard/images' ,  'public/assets/dashboard/images' )
mix.copyDirectory('resources/assets/dashboard/fonts' ,  'public/assets/dashboard/fonts' )
