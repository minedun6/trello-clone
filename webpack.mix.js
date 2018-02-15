let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');
require('laravel-mix-purgecss');

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .disableNotifications()
    .purgeCss()
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.js') ],
});
