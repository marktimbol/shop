var elixir = require('laravel-elixir');
const bowersPath = '../../../bower_components/';
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.browserify([
        '/components/Items.js'
    ], 'public/js/Items.js');

    mix.browserify([
        '/components/Checkout.js'
    ], 'public/js/Checkout.js');

    mix.sass('app.scss', 'resources/assets/css/app.css')
    	.styles([
            bowersPath + 'bootstrap/dist/css/bootstrap.css',
            bowersPath + 'sweetalert/dist/sweetalert.css',
    		'app.css',
    	], 'public/css/app.css')

    	.scripts([
            bowersPath + 'jquery/dist/jquery.js',
            bowersPath + 'bootstrap/dist/js/bootstrap.js',
            bowersPath + 'sweetalert/dist/sweetalert-dev.js',
            'app.js',
    	], 'public/js/app.js')

        .styles([
            bowersPath + 'owl-carousel/owl-carousel/owl.carousel.css',
            bowersPath + 'owl-carousel/owl-carousel/owl.theme.css',
        ], 'public/css/carousel.css')

        .scripts([
            bowersPath + 'owl-carousel/owl-carousel/owl.carousel.js',
            'owl-carousel.js'
        ], 'public/js/carousel.js')

        .copy('bower_components/owl-carousel/owl-carousel/grabbing.png', 'public/build/css')

    	.version([
    		'public/css/app.css',
            'public/js/app.js',
            'public/css/carousel.css',
            'public/js/carousel.js',
            'public/js/Items.js',
    		'public/js/Checkout.js',
    	]);
});
