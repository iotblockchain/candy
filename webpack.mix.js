let mix = require('laravel-mix');

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

// 由于现在的代码结构，运行npm run dev会报错，暂时先注释这两行，后期重构时可放开
// mix.js('resources/assets/js/app.js', 'public/js')
//   .sass('resources/assets/sass/app.scss', 'public/css');

mix.copy('resources/assets/js/intlTelInput.min.js', 'public/js')
   .copy('resources/assets/css/intlTelInput.css', 'public/css')
   .copy('resources/assets/img', 'public/img');
