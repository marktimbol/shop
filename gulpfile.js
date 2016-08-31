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
            '/components/Items/Items.js'
        ], 'public/js/Items.js')

        .browserify([
            '/components/Items/ShowItem.js'
        ], 'public/js/ShowItem.js')        

        .browserify([
            '/components/Items/FeaturedItems.js'
        ], 'public/js/FeaturedItems.js')

        .browserify([
            '/components/Items/RelatedItems.js'
        ], 'public/js/RelatedItems.js')

        .browserify([
            '/components/Checkout/Checkout.js'
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
            'stripe.js',
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

        .styles([
            bowersPath + 'jquery-ui-slider/jquery-ui.css'
        ], 'public/css/price-slider.css')

        .scripts([
            bowersPath + 'jquery-ui-slider/jquery-ui.js',
            'price-slider.js'
        ], 'public/js/price-slider.js')

        .copy('bower_components/owl-carousel/owl-carousel/grabbing.png', 'public/build/css')
        .copy('bower_components/jquery-ui-slider/images', 'public/build/css/images')

    	.version([
    		'public/css/app.css',
            'public/js/app.js',
            'public/css/carousel.css',
            'public/js/carousel.js',
            'public/css/price-slider.css',
            'public/js/price-slider.js',
            'public/js/Items.js',
            'public/js/ShowItem.js',
            'public/js/FeaturedItems.js',
            'public/js/RelatedItems.js',
    		'public/js/Checkout.js',
    	]);
});
