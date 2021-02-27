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

mix.webpackConfig(webpack => {
    return {
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                'window.jQuery': 'jquery',
                Popper: ['popper.js', 'default'],
            })
        ]
    };
});


mix.js('package/resources/js/app/app.js', 'public/vendor/js')
	.js('package/resources/js/app/dropzone.js', 'public/vendor/js') //used when you only need the dropzone resources
	.sass('package/resources/sass/app/dropzone.scss', 'public/vendor/css') //used when you only need the dropzone resources
    .sass('package/resources/sass/app/app.scss', 'public/vendor/css')
    .browserSync('local.orca:8889')
    .version()
    .sourceMaps()
    .copyDirectory('public/vendor/js','/package/resources/dist/js')
    .copyDirectory('public/vendor/css','/package/resources/dist/css');
