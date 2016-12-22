var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.sass('app.scss', 'public/assets/css');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/assets/fonts/bootstrap')

    mix.scripts(
        [
            'jquery.js',
            'plugins/prism.js',
            'plugins/bootstrap.js',
            'plugins/scotchPanels.js',
            'plugins/algoliasearch.js',
            'plugins/typeahead.js',
            'plugins/hogan.js',
            'plugins/mousetrap.js',
            'app.js'
        ],
        'public/assets/js/app.js',
        'resources/assets/js/'
    );

    mix.version(['assets/css/app.css', 'assets/js/app.js']);
});
