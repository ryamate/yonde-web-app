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
 （Mixは、LaravelアプリケーションのためにWebpackのビルドステップを定義するための、クリーンで流暢なAPIを提供します。デフォルトでは、アプリケーションのSassファイルをコンパイルし、すべてのJSファイルをバンドルしています。）
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .version();
