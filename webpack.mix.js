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
   .js('resources/js/Calendar/MonthView.js', 'public/js/Calendar')
   .js('resources/js/Calendar/TimeGridView.js', 'public/js/Calendar')
   .js('resources/js/Calendar/FetchMeetingSchedule.js', 'public/js/Calendar')
   .js('resources/js/Calendar/FetchEventSchedule.js', 'public/js/Calendar')
   .js('resources/js/SelectChosen.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
