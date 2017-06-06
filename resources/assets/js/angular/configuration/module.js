var dependencies = [
    'campsite.services',
    'campsite.directives',
    'campsite.controllers',

    'ngAnimate',
    'ngRoute',
    'ngSanitize',
    'angular.filter',
    'validation',
    'validation.rule',
    'angularFileUpload',
    '720kb.tooltips',
    'toastr',
    'angular.vertilize',
    'ui.select',
    'textAngularSetup',
    'textAngular',
    'rzModule',
    '720kb.datepicker'
];

var campsite = {
    app: angular.module('campsite', dependencies),
    controllers: angular.module('campsite.controllers', []),
    directives: angular.module('campsite.directives', []),
    services: angular.module('campsite.services', [])
};
