const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js/");
mix.sass("resources/sass/app.scss", "public/css/");
mix.sass("resources/sass/toastr.scss", "public/css");
mix.browserSync("http://192.168.2.51:8000");
mix.version();
mix.disableNotifications();
