const mix = require('laravel-mix');

mix
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('postcss-nested'),
        require('autoprefixer')
    ])

mix.js('resources/js/app.js', 'public/js')

if (mix.inProduction()) {
    mix.version();
}

mix.options({
	hmrOptions: {
		host: 'localhost',
		port: 8083
	}
});

mix.webpackConfig({
	resolve: {
		extensions: ['.js', '.vue', '.json'],
		alias: {
		  	'@': __dirname + '/resources/js'
		},
	},
	// add any webpack dev server config here
	devServer: {
		proxy: {
			host: '0.0.0.0', 
			port: 8000,
		},
		watchOptions: {
			aggregateTimeout: 200,
			poll: 5000
		},
	},
});

Mix.listen('configReady', (webpackConfig) => {
	if (Mix.isUsing('hmr')) {
	  	// Remove leading '/' from entry keys
	  	webpackConfig.entry = Object.keys(webpackConfig.entry).reduce((entries, entry) => {
			entries[entry.replace(/^\//, '')] = webpackConfig.entry[entry];
			return entries;
	  	}, {});
  
	  	// Remove leading '/' from ExtractTextPlugin instances
	  	webpackConfig.plugins.forEach((plugin) => {
			if (plugin.constructor.name === 'ExtractTextPlugin') {
		  		plugin.filename = plugin.filename.replace(/^\//, '');
			}
		});
	}
});
