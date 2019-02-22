var Encore = require('@symfony/webpack-encore');
var buildFolder = Encore.isProduction() ? 'dist' : 'build';


Encore
    .setOutputPath('web/' + buildFolder + '/')
    .setPublicPath('/' + buildFolder)
    .addEntry('app', './assets/js/app.js')
    .autoProvidejQuery()
    .enableSourceMaps(!Encore.isProduction)
    .enableVersioning()
    .cleanupOutputBeforeBuild()
    .enableSassLoader()
    .enablePostCssLoader()
;

module.exports = Encore.getWebpackConfig();
