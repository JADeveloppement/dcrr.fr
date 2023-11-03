const mix = require('laravel-mix');
const path = require("path");

require ('mix-tailwindcss');
require('browser-sync');

mix
.js('resources/js/utils.js', 'public/js')
.js('resources/js/index.js', 'public/js')
.js('resources/js/signin.js', 'public/js')
.js('resources/js/profil_entreprise_scripts/liste_site.js', 'public/js/profil_entreprise_scripts')
.js('resources/js/profil_entreprise_scripts/liste_ensemble.js', 'public/js/profil_entreprise_scripts')
.js('resources/js/profil_entreprise_scripts/liste_modele.js', 'public/js/profil_entreprise_scripts')
.js('resources/js/profil_entreprise_scripts/addmodele.js', 'public/js/profil_entreprise_scripts')
.js('resources/js/profil_entreprise_scripts/actions_user.js', 'public/js/profil_entreprise_scripts')

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