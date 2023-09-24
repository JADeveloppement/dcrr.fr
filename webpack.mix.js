const mix = require('laravel-mix');
const path = require("path");

require ('mix-tailwindcss');
require('browser-sync');

mix
.js('resources/js/index.js', 'public/js')

.setPublicPath('public')
.sass('resources/scss/global.scss', 'public/css')
.sass('resources/scss/index.scss', 'public/css')
.sass('resources/scss/profil_client.scss', 'public/css')
.sass('resources/scss/profil_entreprise.scss', 'public/css')

.tailwind('./tailwind.config.js')
.browserSync({
    proxy: 'localhost:8000',
	notify: false
})
.webpackConfig({
    resolve: {
        alias: {
            'jquery': path.resolve(__dirname, 'node_modules/jquery/dist/jquery.js')
        }
    }
 });