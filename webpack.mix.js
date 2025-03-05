const mix = require('laravel-mix');
const activeTheme = process.env.ACTIVE_THEME || 'default-theme';
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
// Debug
console.log(`The active theme is ${activeTheme}`);

// Enable Vue processing
// Compile theme-specific SCSS/JS
mix.js(`resources/views/themes/${activeTheme}/assets/js/app.js`, `public/themes/${activeTheme}/js`)
    .vue()
    .sass(`resources/views/themes/${activeTheme}/assets/scss/app.scss`, `public/themes/${activeTheme}/css`)
    .webpackConfig({
        resolve: {
            extensions: [".*",".wasm",".mjs",".js",".jsx",".json",".vue",".scss"]
        }
    });

// Copy TinyMCE (same files for all themes OR customize per theme if necessary)
mix.copyDirectory('node_modules/tinymce/icons', `public/themes/${activeTheme}/tinymce/icons`);
mix.copyDirectory('node_modules/tinymce/plugins', `public/themes/${activeTheme}/tinymce/plugins`);
mix.copyDirectory('node_modules/tinymce/skins', `public/themes/${activeTheme}/tinymce/skins`);
mix.copyDirectory('node_modules/tinymce/themes', `public/themes/${activeTheme}/tinymce/themes`);
mix.copy('node_modules/tinymce/tinymce.js', `public/themes/${activeTheme}/tinymce/tinymce.js`);
mix.copy('node_modules/tinymce/tinymce.min.js', `public/themes/${activeTheme}/tinymce/tinymce.min.js`);

// Below cannot be located on the installed package.
// mix.copy('node_modules/tinymce/jquery.tinymce.js', 'public/node_modules/tinymce/jquery.tinymce.js');
// mix.copy('node_modules/tinymce/jquery.tinymce.min.js', 'public/node_modules/tinymce/jquery.tinymce.min.js');