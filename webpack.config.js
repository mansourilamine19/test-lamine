const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or subdirectory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/app.js')
    .addEntry('general', './assets/js/general.js')
    .addEntry('app', './assets/js/vendor/modernizr-3.6.0.min.js')
    .addEntry('app', './assets/js/vendor/jquery-3.6.0.min.js')
    .addEntry('app', './assets/js/vendor/jquery-migrate-3.3.0.min.js')
    .addEntry('app', './assets/js/vendor/bootstrap.bundle.min.js')
    .addEntry('app', './assets/js/plugins/slick.js')
    .addEntry('app', './assets/js/plugins/jquery.syotimer.min.js')
    .addEntry('app', './assets/js/plugins/wow.js')
    .addEntry('app', './assets/js/plugins/jquery-ui.js')
    .addEntry('app', './assets/js/plugins/perfect-scrollbar.js')
    .addEntry('app', './assets/js/plugins/magnific-popup.js')
    .addEntry('app', './assets/js/plugins/select2.min.js')
    .addEntry('app', './assets/js/plugins/waypoints.js')
    .addEntry('app', './assets/js/plugins/counterup.js')
    .addEntry('app', './assets/js/plugins/jquery.countdown.min.js')
    .addEntry('app', './assets/js/plugins/images-loaded.js')
    .addEntry('app', './assets/js/plugins/isotope.js')
    .addEntry('app', './assets/js/plugins/scrollup.js')
    .addEntry('app', './assets/js/plugins/jquery.vticker-min.js')
    .addEntry('app', './assets/js/plugins/jquery.theia.sticky.js')
    .addEntry('app', './assets/js/plugins/jquery.elevatezoom.js')
    .addEntry('app', './assets/js/main.js?v=3.4')
    .addEntry('app', './assets/js/shop.js?v=3.4')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // configure Babel
    // .configureBabel((config) => {
    //     config.plugins.push('@babel/a-babel-plugin');
    // })

    // enables and configure @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.23';
    })

    // enables Sass/SCSS support
    //.enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    //.enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
