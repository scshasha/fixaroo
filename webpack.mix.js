const mix = require('laravel-mix');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
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

// Debug logs
console.log(`Running in ${mix.inProduction() ? 'production' : 'development'} mode`);
console.log(`The currently activated THEME is ${activeTheme}`);

// Enable Vue processing
mix.vue();

// Add the CleanWebpackPlugin to remove old files
mix.webpackConfig({
    plugins: [
        new CleanWebpackPlugin({
            cleanOnceBeforeBuildPatterns: [
                `public/themes/${activeTheme}/css/*`,
                `public/themes/${activeTheme}/js/*`,
                `public/themes/${activeTheme}/img/*`,
                `public/themes/${activeTheme}/fonts/*`
            ]
        })
    ],
    resolve: {
        extensions: [".js", ".jsx", ".json", ".vue", ".scss"]
    }
});

// Combine and Minify JS Files for the Active Theme
mix.scripts(
    [
        `resources/views/themes/${activeTheme}/assets/js/app.js`,
        `resources/views/themes/${activeTheme}/assets/js/theme.js`
    ],
    `public/themes/${activeTheme}/js/all.js`
);

// Compile and Minify SCSS Files for the Active Theme
[
    'app.scss',
].forEach(scssFile => {
    mix.sass(
        `resources/views/themes/${activeTheme}/assets/scss/${scssFile}`,
        `public/themes/${activeTheme}/css`
    );
});

// Copy asset directories (img, fonts, etc.) if they exist
const assetDirs = ['img', 'fonts'];

assetDirs.forEach(dir => {
    mix.copyDirectory(
        `resources/views/themes/${activeTheme}/assets/${dir}`,
        `public/themes/${activeTheme}/${dir}`
    );
});

// Copy TinyMCE core files and directories
const tinymceAssets = [
    { src: 'node_modules/tinymce/icons', dest: `public/themes/${activeTheme}/tinymce/icons` },
    { src: 'node_modules/tinymce/plugins', dest: `public/themes/${activeTheme}/tinymce/plugins` },
    { src: 'node_modules/tinymce/skins', dest: `public/themes/${activeTheme}/tinymce/skins` },
    { src: 'node_modules/tinymce/themes', dest: `public/themes/${activeTheme}/tinymce/themes` },
    { src: 'node_modules/tinymce/tinymce.js', dest: `public/themes/${activeTheme}/tinymce/tinymce.js` },
    { src: 'node_modules/tinymce/tinymce.min.js', dest: `public/themes/${activeTheme}/tinymce/tinymce.min.js` }
];

tinymceAssets.forEach(({ src, dest }) => mix.copy(src, dest));

// Enable versioning for production to avoid caching issues
if (mix.inProduction()) {
    mix.version();
}
