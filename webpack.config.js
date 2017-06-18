var path = require('path');
var webpack = require('webpack');
var jquery = require('jquery')
var reactMaterialize = require('react-materialize')

module.exports = {
    entry: './src/AppBundle/Resources/assets/js/entry.js',
    output: { path: __dirname + '/web/assets/js/', filename: 'bundle.js' },
    module: {
        loaders: [
            {
                test: /.jsx?$/,
                loader: 'babel-loader',
                exclude: /node_modules/,
                query: {
                    presets: ['es2015', 'react']
                }
            },
            {
                test: /\.scss$/,
                loaders: ['style-loader', 'css-loader', 'sass-loader']
            }
        ],
    },
    externals: {
        "jquery": "$"
    },
    resolve: {
        modules: [
            path.resolve('./src/AppBundle/Resources/assets/js'),
            path.resolve('./src/AppBundle/Resources/assets/scss'),
            path.resolve('./node_modules')
        ]
    },
};