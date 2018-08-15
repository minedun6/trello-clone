let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');
let purgeCss = require('laravel-mix-purgecss');

mix.js('resources/assets/symmetryk/js/app.js', 'public/symmetryk/js')
    .js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/symmetryk/sass/app.scss', 'public/symmetryk/css')
    .disableNotifications()
    .purgeCss()
    .options({
        processCssUrls: false,
        postCss: [
            tailwindcss('./tailwind.js'),
            require('autoprefixer')
        ],
    });

if (mix.inProduction()) {
    mix.version();
}