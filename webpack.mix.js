const mix = require('laravel-mix');
const MonacoWebpackPlugin = require('monaco-editor-webpack-plugin');


mix.extend('monaco', new class {
    webpackEntry(entry){
        entry.add('monaco', './resources/js/monaco.js');
    }
    webpackPlugins(){
        return new MonacoWebpackPlugin({
			languages: ["typescript", "javascript", "css"],
		});
    }
});


mix.js('resources/js/app.js', 'public/js');
mix.sass('resources/sass/app.scss', 'public/css');
mix.monaco(); 


mix.webpackConfig({
    entry: {
        main: ['./resources/sass/app.scss']
    },
    output: {
        filename: '[name].js',
        chunkFilename: 'js/[name].[contenthash].js'
    }
});

