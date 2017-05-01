const elixir = require('laravel-elixir');

require('laravel-elixir-ng-annotate');

var appScripts = [
    'angular/configuration/module.js',
    'angular/configuration/config.js',
    'angular/app/directives/*.js',
    'angular/app/services/*.js',
    'angular/app/controllers/*.js'
];

elixir(function(mix) {
    mix.annotate(appScripts).scripts('annotated.js','public/assets/js/angular.js', 'public/js/');
});

elixir(function(mix) {

    mix.sass(
        [
            'app.scss'
        ],
        'public/assets/css/app.css'
    )
        .scripts(
            [
                'plugins/angular.min.js',
                'plugins/*.js'
            ],
            'public/assets/js/vendor.js'
        )
        .version(['assets/css/app.css', 'js/app.js', 'assets/js/angular.js', 'assets/js/vendor.js'])

        .browserSync({proxy: 'localhost:8888'});
});