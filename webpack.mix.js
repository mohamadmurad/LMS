const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.sass('resources/scss/lms.scss','public/assets/front/css/front.css');
mix.sass('resources/scss/frontall.scss','public/css/frontall.css');
// mix.js('resources/js/frontall.js','public/js/frontall.js');

// mix.js('resources/js/htmlifier.js', 'public/js');
// mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
//     require('tailwindcss'),
//     require('autoprefixer'),
// ]);
