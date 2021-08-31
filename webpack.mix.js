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

// mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
//     require('postcss-import'),
//     require('tailwindcss'),
//     require('autoprefixer'),
// ]);

let BlueprintAssets = '/Modules/Blueprint/Resources/'


mix.setPublicPath('public')
    .version()
    .vue()

    // ANNOUNCEMENT
    .sass( __dirname + '/Modules/Announcement/Resources/assets/sass/app.scss', 'public/css/announcement/announcement.css')
    .sass( __dirname + '/Modules/Announcement/Resources/assets/sass/photopage.scss', 'public/css/announcement/photopage.css')

    // HOME PAGE
    .js(__dirname + '/Modules/HomePage/Resources/assets/js/app.js', 'public/js/homepage.js')
    .sass( __dirname + '/Modules/HomePage/Resources/assets/sass/app.scss', 'public/css/homepage.css')
    .sass( __dirname + '/Modules/HomePage/Resources/assets/sass/letterhead.scss', 'public/css/letterhead.css')

    // INDEX MODULE
    .js(__dirname + '/Modules/Index/Resources/assets/js/app.js', 'js/index.js')

    // QUESTIONNAIRE MODULE
    .js(__dirname + '/Modules/Questionnaire/Resources/assets/js/app.js', 'js/questionnaire.js')


    // VEHICLE DATABASE
    .js(__dirname + '/Modules/Vehicles/Resources/assets/js/inspectionReport.js', 'js/vehicles/inspectionReport.js')


    // BLUEPRINT STUFF

    .copy(__dirname +  BlueprintAssets + "img/floors/transit130.png", 'public/img/blueprint/floors/transit130.png')
    .copy(__dirname +  BlueprintAssets + "img/floors/transit148.png", 'public/img/blueprint/floors/transit148.png')
    .copy(__dirname +  BlueprintAssets + "img/floors/transit148ext.png", 'public/img/blueprint/floors/transit148ext.png')

    .copy(__dirname +  BlueprintAssets + "img/seats/double-passenger.png", 'public/img/blueprint/seats/double-passenger.png')
    .copy(__dirname +  BlueprintAssets + "img/seats/single-passenger.png", 'public/img/blueprint/seats/single-passenger.png')
    .copy(__dirname +  BlueprintAssets + "img/seats/double-driver.png", 'public/img/blueprint/seats/double-driver.png')
    .copy(__dirname +  BlueprintAssets + "img/seats/single-driver.png", 'public/img/blueprint/seats/single-driver.png')

    .js(__dirname + BlueprintAssets + '/js/floor_layout.js', 'js/blueprint/floor_layout.js')






    // SHARED STUFF
    .copy(__dirname + '/Modules/Labour/Resources/assets/img/search.gif', 'public/img/search.gif' )
    .copy(__dirname + '/Modules/Labour/Resources/assets/img/on-flag.png', 'public/img/on-flag.png' )
    .copy(__dirname + '/Modules/Labour/Resources/assets/img/off-flag.png', 'public/img/off-flag.png' )
    .copy(__dirname + '/Modules/UserManagement/Resources/assets/img/checkmark.png', 'public/img/checkmark.png' )



mix.version();
