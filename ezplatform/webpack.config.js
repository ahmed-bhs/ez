var Encore = require('@symfony/webpack-encore');
var buildFolder = Encore.isProduction() ? 'dist' : 'build';
const CopyWebpackPlugin = require('copy-webpack-plugin');

Encore  .addPlugin(new CopyWebpackPlugin([
    { from: './assets/images', to: 'images' }
]))
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
